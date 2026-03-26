<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Таблица умножения</title>

<style>

/* оформление меню */
#main_menu a{
margin-right:15px;
text-decoration:none;
color:black;
}

#side_menu a{
display:block;
text-decoration:none;
color:black;
margin:5px;
}

.selected{
color:red;
font-weight:bold;
}

/* таблица */
table{
border-collapse:collapse;
}

td{
border:1px solid black;
padding:5px;
text-align:center;
}

/* блочная верстка */

.ttRow{
display:inline-block;
margin:10px;
padding:10px;
border:1px solid black;
}

.ttSingleRow{
font-size:20px;
border:1px solid black;
padding:15px;
display:inline-block;
}

</style>

</head>

<body>

<?php

/*
ФУНКЦИЯ: делает число ссылкой на таблицу умножения
Если число <=9 → делаем ссылку
Если больше → просто число
*/
function outNumAsLink($x)
{
if($x<=9)
return '<a href="?content='.$x.'">'.$x.'</a>';
else
return $x;
}


/*
ФУНКЦИЯ: выводит один столбец таблицы умножения

Параметр:
$n → число для таблицы (например 4)

Что делает:
Выводит:
4x2=8
4x3=12
и т.д.
*/
function outRow($n)
{

for($i=2;$i<=9;$i++)
{

echo outNumAsLink($n).' x '.
outNumAsLink($i).' = '.
outNumAsLink($n*$i);

echo "<br>";

}

}


/*
ФУНКЦИЯ: вывод таблицы через TABLE (табличная верстка)
*/
function outTableForm()
{

echo "<table>";

if(!isset($_GET['content']))
{

echo "<tr>";

for($i=2;$i<=9;$i++)
{

echo "<td>";

outRow($i);

echo "</td>";

}

echo "</tr>";

}

else
{

echo "<tr><td>";

outRow($_GET['content']);

echo "</td></tr>";

}

echo "</table>";

}


/*
ФУНКЦИЯ: вывод таблицы через DIV (блочная верстка)
*/
function outDivForm()
{

if(!isset($_GET['content']))
{

for($i=2;$i<=9;$i++)
{

echo '<div class="ttRow">';

outRow($i);

echo "</div>";

}

}

else
{

echo '<div class="ttSingleRow">';

outRow($_GET['content']);

echo "</div>";

}

}

?>

<!-- ГЛАВНОЕ МЕНЮ -->
<div id="main_menu">

<?php

echo '<a href="?html_type=TABLE"';

if(isset($_GET['html_type']) && $_GET['html_type']=="TABLE")
echo ' class="selected"';

echo '>Табличная верстка</a>';

echo '<a href="?html_type=DIV"';

if(isset($_GET['html_type']) && $_GET['html_type']=="DIV")
echo ' class="selected"';

echo '>Блочная верстка</a>';

?>

</div>

<hr>

<!-- БОКОВОЕ МЕНЮ -->

<div id="side_menu">

<?php

echo '<a href="index.php"';

if(!isset($_GET['content']))
echo ' class="selected"';

echo '>Вся таблица</a>';

for($i=2;$i<=9;$i++)
{

echo '<a href="?content='.$i.'"';

if(isset($_GET['content']) && $_GET['content']==$i)
echo ' class="selected"';

echo '>Таблица на '.$i.'</a>';

}

?>

</div>

<hr>

<!-- ТАБЛИЦА -->

<?php

if(!isset($_GET['html_type']) || $_GET['html_type']=="TABLE")
outTableForm();

else
outDivForm();

?>

<hr>

<!-- ИНФОРМАЦИЯ -->

<?php

if(!isset($_GET['html_type']) || $_GET['html_type']=="TABLE")
$s="Табличная верстка. ";
else
$s="Блочная верстка. ";

if(!isset($_GET['content']))
$s.="Полная таблица. ";
else
$s.="Таблица на ".$_GET['content'].". ";

echo $s;

echo date("d.m.Y H:i:s");

?>

</body>
</html>