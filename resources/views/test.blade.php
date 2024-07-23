<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фильтрация залов</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #filter {
            width: 20%;
            float: left;
        }
        #results {
            width: 50%;
            float: left;
            margin-left: 2%;
        }
        #map {
            width: 25%;
            float: right;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div id="filter" class="p-3">
            <h4>Фильтр</h4>
            <form id="filterForm">
                <div class="form-group">
                    <label for="name">Поиск по названию</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="areaRange">Площадь зала (м²)</label>
                    <div class="d-flex">
                        <input type="number" class="form-control mr-2" id="areaMin" placeholder="Min" min="0" max="500">
                        <input type="range" class="form-control-range mx-2" id="areaRangeMin" min="0" max="500" step="1">
                        <input type="range" class="form-control-range mx-2" id="areaRangeMax" min="0" max="500" step="1">
                        <input type="number" class="form-control ml-2" id="areaMax" placeholder="Max" min="0" max="500">
                    </div>
                </div>
                <div class="form-group">
                    <label for="priceRange">Цена (руб)</label>
                    <div class="d-flex">
                        <input type="number" class="form-control mr-2" id="priceMin" placeholder="Min" min="0" max="10000">
                        <input type="range" class="form-control-range mx-2" id="priceRangeMin" min="0" max="10000" step="100">
                        <input type="range" class="form-control-range mx-2" id="priceRangeMax" min="0" max="10000" step="100">
                        <input type="number" class="form-control ml-2" id="priceMax" placeholder="Max" min="0" max="10000">
                    </div>
                </div>
                <div class="form-group">
                    <label>Удобства</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="cooler">
                        <label class="form-check-label" for="cooler">Кулер с водой</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="lighting">
                        <label class="form-check-label" for="lighting">Подсветка</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="speaker">
                        <label class="form-check-label" for="speaker">Колонка</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="wifi">
                        <label class="form-check-label" for="wifi">Wi-Fi</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sort">Сортировка по цене</label>
                    <select class="form-control" id="sort">
                        <option value="asc">По возрастанию</option>
                        <option value="desc">По убыванию</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Применить фильтр</button>
            </form>
        </div>
        <div id="results" class="p-3">
            <h4>Результаты поиска</h4>
            <!-- Здесь будут отображаться результаты поиска -->
        </div>
        <div id="map" class="p-3">
            <h4>Карта</h4>
            <div id="mapContainer" style="width: 100%; height: 500px; background-color: #eaeaea;">
                <!-- Здесь будет карта -->
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Скрипт для отображения карты -->
    <script>
        function syncInputs(rangeMin, rangeMax, inputMin, inputMax) {
            rangeMin.addEventListener('input', function() {
                inputMin.value = this.value;
                if (parseInt(rangeMin.value) > parseInt(rangeMax.value)) {
                    rangeMax.value = this.value;
                    inputMax.value = this.value;
                }
            });

            rangeMax.addEventListener('input', function() {
                inputMax.value = this.value;
                if (parseInt(rangeMax.value) < parseInt(rangeMin.value)) {
                    rangeMin.value = this.value;
                    inputMin.value = this.value;
                }
            });

            inputMin.addEventListener('input', function() {
                rangeMin.value = this.value;
                if (parseInt(inputMin.value) > parseInt(inputMax.value)) {
                    inputMax.value = this.value;
                    rangeMax.value = this.value;
                }
            });

            inputMax.addEventListener('input', function() {
                rangeMax.value = this.value;
                if (parseInt(inputMax.value) < parseInt(inputMin.value)) {
                    inputMin.value = this.value;
                    rangeMin.value = this.value;
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            syncInputs(
                document.getElementById('areaRangeMin'),
                document.getElementById('areaRangeMax'),
                document.getElementById('areaMin'),
                document.getElementById('areaMax')
            );
            syncInputs(
                document.getElementById('priceRangeMin'),
                document.getElementById('priceRangeMax'),
                document.getElementById('priceMin'),
                document.getElementById('priceMax')
            );
        });

        document.getElementById('filterForm').addEventListener('submit', function(event) {
            event.preventDefault();
            // Здесь можно добавить логику фильтрации и отображения результатов
        });
    </script>
</body>
</html>
