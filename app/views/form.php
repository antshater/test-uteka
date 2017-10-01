<? use App\Components\FlatsClient; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Поиск квартир</title>
</head>
<body>
<h1>Поиск квартир</h1>
<form method="post" style="margin-bottom: 20px">
    <div>
        <label>Тип недвижимости</label>
        <select name="search[type]">
            <? $optGroupOpened = false; ?>
            <? foreach ($realtyTypes as $type) : ?>
                <? if ($type['isHeader']) : ?>
                    <? if ($optGroupOpened) : ?>
                        </optgroup>
                    <? endif; ?>
                    <? $optGroupOpened = true; ?>
                    <optgroup label="<?= $type['title'] ?>">
                <? else : ?>
                    <option
                        <? if ($form->type() == $type['id']) : ?>
                            selected="selected"
                        <? endif; ?>
                            value="<?= $type['id'] ?>">
                        <?= $type['title'] ?>
                    </option>
                <? endif; ?>
                <? endforeach; ?>
            </optgroup>
        </select>
    </div>
    <div>
        <label>Цена</label>
        от <input value="<?=$form->price('from') ?>" name="search[price][from]"/> до <input value="<?=$form->price('to') ?>" name="search[price][to]"/>
    </div>
    <div>
        <label>Комнаты</label>
    </div>
    <div>
        <select style="width: 100px" multiple name="search[rooms][]">
            <? foreach ($rooms as $room) : ?>
                <option
                    <? if (in_array($room, $form->rooms())) : ?>
                        selected="selected"
                    <? endif; ?>
                        value="<?= $room ?>"
                >
                    <?= $room ?>
                </option>
            <? endforeach; ?>
        </select>
    </div>
    <div>
        <label>Только с фото</label>
        <input <? if ($form->onlyPhoto()) : ?> checked="checked" <? endif; ?> name="search[only_photo]" type="checkbox"/>
    </div>
    <button>Найти</button>
</form>
<table border="1">
    <tbody>
        <? foreach ($results as $row) : ?>
            <tr>
            <? foreach ($row as $cell) : ?>
                <td><?=$cell ?></td>
            <? endforeach; ?>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>
</body>
</html>
