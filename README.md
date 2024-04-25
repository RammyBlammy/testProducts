# testProducts

В каком порядке все запускать:
1. скачать проект
2. запустить композер в проекте через Compose Up.
3. Как только все контейнеры запустятся, перейти в php контейнер и запустить миграции: cd /usr/share/nginx/html && php artisan migrate
4. Сайт готов к работе.
5. Для загрузки данных нужно выбрать файл и нажать кнопку "Загрузить":

   ![image](https://github.com/RammyBlammy/testProducts/assets/110770366/cb0ddaa5-52a5-4bc3-b7df-2a8936e287ac)
6. Перекинет на страницу загрузки, где можно будет перейти на страницу со списокм товаров или вернуться назад:
   
   ![image](https://github.com/RammyBlammy/testProducts/assets/110770366/97d08f36-46ab-418e-aa29-dd9c88ab7556)
7. Каждый элемент списка кликабельный, по клику переходит на подробную информацию по этому товару:

  ![image](https://github.com/RammyBlammy/testProducts/assets/110770366/aa37ef69-e6e2-41c0-9e09-ee27e00565cc)
  
  ![image](https://github.com/RammyBlammy/testProducts/assets/110770366/d3e9f642-1d20-4ec7-935a-e00e01ec5560)

Данные для доступа в БД:  

      - HOST=postgres
      
      - PORT=5432
      
      - DATABASE=app
      
      - USERNAME=app
      
      - PASSWORD=12345678

