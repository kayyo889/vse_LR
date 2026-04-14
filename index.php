<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Сортировка массива</title>
    <style>
        table { border-collapse: collapse; margin-bottom: 15px; }
        td { padding: 6px; }
    </style>
</head>
<body>

<h2>Введите элементы массива</h2>

<form action="sort.php" method="POST" target="_blank">
    <table id="elements" border="1">
        <tr>
            <td>0</td>
            <td><input type="text" name="element0" value=""></td>
        </tr>
    </table>

    <input type="hidden" id="arrLength" name="arrLength" value="1">

    <br>

    <label>Алгоритм сортировки:</label>
    <select name="algorithm">
        <option value="selection">Сортировка выбором</option>
        <option value="bubble">Пузырьковая сортировка</option>
        <option value="shell">Сортировка Шелла</option>
        <option value="gnome">Гномья сортировка</option>
        <option value="quick">Быстрая сортировка</option>
        <option value="native">Встроенная sort()</option>
    </select>

    <br><br>

    <input type="button" value="➕ Добавить элемент" onclick="addElement()">
    <input type="submit" value="▶ Сортировать массив">
</form>

<script>
    function addElement() {
        const table = document.getElementById("elements");
        const index = table.rows.length;

        const row = table.insertRow(index);

        const cellIndex = row.insertCell(0);
        cellIndex.textContent = index;

        const cellInput = row.insertCell(1);
        const input = document.createElement("input");
        input.type = "text";
        input.name = "element" + index;
        cellInput.appendChild(input);

        // Обновляем скрытое поле с длиной массива
        document.getElementById("arrLength").value = index + 1;
    }
</script>

</body>
</html>