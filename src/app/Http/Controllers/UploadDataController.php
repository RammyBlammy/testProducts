<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Models\CustomFields;
use App\Models\ImageProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class UploadDataController extends Controller
{


    const NAME_TO_COLUMN_TRANSLATED = [
        'Группы' => '',
        'UUID' => '',
        'Тип' => '',
        'Код' => '',
        'Наименование' => 'name',
        'Внешний код' => 'external_code',
        'Артикул' => '',
        'Единица измерения' => '',
        'Цена: Цена продажи' => 'price',
        'Валюта (Цена продажи)' => '',
        'Описание' => 'description',
        'Закупочная цена' => '',
        'Валюта (Закупочная цена)' => '',
        'Штрихкод EAN13' => '',
        'Штрихкод EAN8' => '',
        'Штрихкод Code128' => '',
        'Штрихкод UPC' => '',
        'Штрихкод GTIN' => '',
        'Признак предмета расчета' => '',
        'Запретить скидки при продаже в розницу' => '',
        'Минимальная цена' => '',
        'Валюта (Минимальная цена)' => '',
        'Страна' => '',
        'НДС' => '',
        'Поставщик' => '',
        'Архивный' => '',
        'Вес' => '',
        'Весовой товар' => '',
        'Маркированная продукция' => '',
        'Объем' => '',
        'Содержит акцизную марку' => '',
        'Доп. поле: Размер' => 'size',
        'Доп. поле: Цвет' => 'color',
        'Доп. поле: Бренд' => 'brand',
        'Доп. поле: Состав' => 'composition',
        'Доп. поле: Кол-во в упаковке' => 'count_by_package',
        'Доп. поле: Ссылка на упаковку' => 'link_package',
        'Доп. поле: Ссылки на фото' => 'links_image',
        'Доп. поле: seo title' => 'seo_title',
        'Доп. поле: seo h1' => 'seo_h1',
        'Доп. поле: seo description' => 'seo_description',
        'Доп. поле: Вес товара(г)' => 'weight',
        'Доп. поле: Ширина(мм)' => 'width',
        'Доп. поле: Высота(мм)' => 'height',
        'Доп. поле: Длина(мм)' => 'length',
        'Доп. поле: Вес упаковки(г)' => 'weight_package',
        'Доп. поле: Ширина упаковки(мм)' => 'width_package',
        'Доп. поле: Высота упаковки(мм)' => 'height_package',
        'Доп. поле: Длина упаковки(мм)' => 'length_package',
        'Доп. поле: Категория товара' => 'category'
    ];

    private $priceColumns = ['price'];
    private $columnsOrder;

    /* 
     * Загрузка из файла и запись данных в бд
     * /upload-data?file
     *  
     */
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $rows = Excel::toArray(new ProductImport, $file)[0];
                echo 'Файл будет обработан, ожидайте...<br><br><a href="/products">Просмотреть список товаров</a><br><br><a href="/">Вернуться на главную</a';
                fastcgi_finish_request();
                $valueToKey = [];
                foreach ($rows as $key => $row) {
                    if ($key == 0) {
                        $this->columnNameOrder($row);
                        $valueToKey = array_flip($this->columnsOrder);
                        continue;
                    }
                    foreach ($row as $k => $v) {
                        if ($v == '') {
                            $row[$k] = null;
                        }
                        if (isset($valueToKey[$k]) && in_array($valueToKey[$k], $this->priceColumns)) {
                            $row[$k] = floatval($v);
                        }
                    }

                    $productId = $this->createProduct($row);
                    $customFiledsOfProduct = $this->createProductCustomFields($productId, $row);
                    $this->createImagesOfProduct($productId, $row);
                }
            }
        }
    }

    private function columnNameOrder(array $data)
    {
        foreach ($data as $key => $value) {
            if (isset(self::NAME_TO_COLUMN_TRANSLATED[$value]) && self::NAME_TO_COLUMN_TRANSLATED[$value] != '')
                $this->columnsOrder[self::NAME_TO_COLUMN_TRANSLATED[$value]] = $key;
        }
        print_r($this->columnsOrder);
    }

    private function createProduct(array $data)
    {
        $fields = [
            'external_code',
            'name',
            'description',
            'price',
        ];
        $values = [];
        foreach ($fields as $value) {
            if (isset($this->columnsOrder[$value]) && isset($data[$this->columnsOrder[$value]])) {
                $values[$value] = $data[$this->columnsOrder[$value]];
            }
        }
        $id = Product::insertGetId($values);
        return $id;
    }

    private function createProductCustomFields(int $productId, array $data)
    {
        $fields = [
            'size',
            'color',
            'brand',
            'composition',
            'count_by_package',
            'link_package',
            'links_image',
            'seo_title',
            'seo_h1',
            'seo_description',
            'weight',
            'width',
            'height',
            'length',
            'weight_package',
            'width_package',
            'height_package',
            'length_package',
            'category'
        ];
        $values = ['product_id' => $productId];
        foreach ($fields as $value) {
            if (isset($this->columnsOrder[$value]) && isset($data[$this->columnsOrder[$value]])) {
                $values[$value] = $data[$this->columnsOrder[$value]];
            }
        }
        $res = CustomFields::insert($values);

        return $res;
    }

    private function createImagesOfProduct(int $productId, array $data)
    {
        if (isset($this->columnsOrder['links_image']) && isset($data[$this->columnsOrder['links_image']])) {
            $links = explode(", ", $data[$this->columnsOrder['links_image']]);
            foreach ($links as $link) {
                if (ImageProduct::where(['product_id' => $productId, 'img_link' => $link])->count()) {
                    continue;
                }
                $partsLink = explode('/', $link);
                $fileName = end($partsLink);
                $fileTo =  __DIR__ . '/../../../resources/products/' . $fileName;
                if (!file_exists($fileTo)) {
                    copy($link, $fileTo);
                }
                $res = ImageProduct::insert([
                    'product_id' => $productId,
                    'img_link' => $link,
                    'path' => '/products/' . $fileName
                ]);
            }
        }
    }
}
