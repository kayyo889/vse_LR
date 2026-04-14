<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function isNotNumber($arg) {
    if ($arg === '') return true;
    return !is_numeric($arg);
}

// ---------- СОРТИРОВКИ (все возвращают новый массив) ----------

function selectionSort(array $arr) {
    $n = count($arr);
    $result = $arr; // копия
    for ($i = 0; $i < $n - 1; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            if ($result[$j] < $result[$min]) {
                $min = $j;
            }
        }
        if ($min != $i) {
            $tmp = $result[$i];
            $result[$i] = $result[$min];
            $result[$min] = $tmp;
        }
    }
    return $result;
}

function bubbleSort(array $arr) {
    $result = $arr;
    $n = count($result);
    for ($j = 0; $j < $n - 1; $j++) {
        for ($i = 0; $i < $n - 1 - $j; $i++) {
            if ($result[$i] > $result[$i + 1]) {
                $tmp = $result[$i];
                $result[$i] = $result[$i + 1];
                $result[$i + 1] = $tmp;
            }
        }
    }
    return $result;
}

function shellSort(array $arr) {
    $result = $arr;
    $n = count($result);
    for ($gap = intdiv($n, 2); $gap > 0; $gap = intdiv($gap, 2)) {
        for ($i = $gap; $i < $n; $i++) {
            $temp = $result[$i];
            $j = $i;
            while ($j >= $gap && $result[$j - $gap] > $temp) {
                $result[$j] = $result[$j - $gap];
                $j -= $gap;
            }
            $result[$j] = $temp;
        }
    }
    return $result;
}

function gnomeSort(array $arr) {
    $result = $arr;
    $i = 1;
    $n = count($result);
    while ($i < $n) {
        if ($i == 0 || $result[$i] >= $result[$i - 1]) {
            $i++;
        } else {
            $tmp = $result[$i];
            $result[$i] = $result[$i - 1];
            $result[$i - 1] = $tmp;
            $i--;
        }
    }
    return $result;
}

function quickSort(array $arr) {
    if (count($arr) < 2) return $arr;
    $pivot = $arr[0];
    $left = $equal = $right = [];
    foreach ($arr as $val) {
        if ($val < $pivot) $left[] = $val;
        elseif ($val > $pivot) $right[] = $val;
        else $equal[] = $val;
    }
    return array_merge(quickSort($left), $equal, quickSort($right));
}

// ---------- ОСНОВНАЯ ЛОГИКА ----------

if (!isset($_POST['element0']) && !isset($_POST['arrLength'])) {
    echo "Массив не задан";
    exit();
}

$arr = [];
$length = (int)$_POST['arrLength'];

for ($i = 0; $i < $length; $i++) {
    $key = 'element' . $i;
    if (!isset($_POST[$key])) {
        echo "Ошибка: отсутствует элемент $i";
        exit();
    }
    $val = $_POST[$key];
    if (isNotNumber($val)) {
        echo "Ошибка: '$val' не число (используйте точку для дробей)";
        exit();
    }
    $arr[] = (float)$val;
}

if (empty($arr)) {
    echo "Массив пуст, сортировка не требуется.";
    exit();
}

// Вывод исходного массива
echo "<h3>Исходный массив:</h3>";
echo implode(", ", $arr) . "<br><br>";
echo "Массив валиден<br><br>";

$algorithm = $_POST['algorithm'] ?? '';
$start = microtime(true);

// Выполняем сортировку и получаем НОВЫЙ отсортированный массив
switch ($algorithm) {
    case "selection":
        echo "<h3>Сортировка выбором</h3>";
        $sorted = selectionSort($arr);
        break;
    case "bubble":
        echo "<h3>Пузырьковая сортировка</h3>";
        $sorted = bubbleSort($arr);
        break;
    case "shell":
        echo "<h3>Сортировка Шелла</h3>";
        $sorted = shellSort($arr);
        break;
    case "gnome":
        echo "<h3>Сортировка гнома</h3>";
        $sorted = gnomeSort($arr);
        break;
    case "quick":
        echo "<h3>Быстрая сортировка</h3>";
        $sorted = quickSort($arr);
        break;
    case "native":
        echo "<h3>Встроенная sort()</h3>";
        $sorted = $arr;
        sort($sorted);
        break;
    default:
        echo "Неизвестный алгоритм.";
        exit();
}

$time = microtime(true) - $start;

// ВАЖНО: выводим именно $sorted, а не исходный $arr!
echo "<br><b>Итоговый массив:</b><br>";
echo implode(", ", $sorted);

echo "<br><br>Сортировка завершена<br>";
echo "Время: " . round($time, 6) . " секунд";
?>