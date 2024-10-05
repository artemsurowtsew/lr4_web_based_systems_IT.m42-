<?php
header("Content-Type: text/html; charset=utf-8");

// Трейт для демографічних характеристик
trait Demographics {
    public $population;
    public $language;

    public function setDemographics($population, $language) {
        $this->population = $population;
        $this->language = $language;
    }

    public function showDemographics() {
        echo "<p>Population: " . $this->population . "</p>";
        echo "<p>Language: " . $this->language . "</p>";
    }
}

// Трейт для характеристик площі
trait Area {
    public $area;

    public function setArea($area) {
        $this->area = $area;
    }

    public function showArea() {
        echo "<p>Area: " . $this->area . "</p>";
    }
}

// Абстрактний клас Країни
abstract class Country {
    use Demographics, Area;
    public function show() {
        // Використовуємо методи трейтов для відображення даних
        $this->showArea();
        $this->showDemographics();
    }

    abstract public function Analyze();
}

// Клас для класифікації за площею
class SpecificCountry extends Country {
    use Demographics, Area; // Використовуємо два трейти

    protected $mark;

    public function __construct($area, $population, $language, $mark) {
        $this->setArea($area); // Викликаємо метод з трейту Area
        $this->setDemographics($population, $language); // Викликаємо метод з трейту Demographics
        $this->mark = $mark;
    }

    // Аналіз розміру країни
    public function Analyze() {
        if ($this->area > 10000) {
            echo "<p>Це середня Країна</p>";
            $this->mark++;
        } elseif ($this->area < 10000) {
            echo "<p>Це маленька Країна</p>";
            $this->mark--;
        } else {
            echo "<p>Це велика Країна</p>";
            $this->mark += 2;
        }
    }
}

// Приклад використання
$object1 = new SpecificCountry(45339, "1,349 мільйона", "Естонська", 1);
$object2 = new SpecificCountry(208, "36 469 тисяч", "Французька", 1);

echo "<h2>Country 1:</h2>";
$object1->show();
$object1->Analyze();

echo "<h2>Country 2:</h2>";
$object2->show();
$object2->Analyze();

// Очищуємо об'єкти з пам'яті
unset($object1);
unset($object2);
?>
