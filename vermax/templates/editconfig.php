<?php
$conf_array = array(
    "icons" => "Папка с логотипами каналов",
    "playlist_update_interval" => "",
    "update_url" => "Ссылка на файл с информаций об обновлениях, может быть как полной ссылкой [вида http://example.com/update.properties], так и относительной.",
    "child_lock_pin_code" => "Пин-код родительского контроля [только цифры, не более 11 символов, по умолчанию 0000]",
    "provider_notifications_check_interval" => "Интервал проверки уведомлений от провайдера [в минутах, по умолчанию 120]",
    "multicast_reconnect_timeout" => "",
    "error_message_no_video" => "",
    "reports_min_time_on_channel" => "",
    "reports_min_events_count" => "",
    "error_monitor" => "",
    "stat_monitor" => "",
);
$yet_conf_array = array();
?>
<p>Название конфига <input name="config_name" type="text" value="<?php echo $conf_n; ?>"></p>
<div class="l_col col">
    <table id="e_conf" class="conf_block">
        <tbody>
            <tr>
                <th colspan="3">Конфигурация</th>
            </tr>
            <tr>
                <td>Параметр</td>
                <td>Значение</td>
                <td>Комментарий</td>
            </tr>
            <?php
            foreach($conf_list['configs'] as $params){
                ?>
                <tr id="c_<?php echo $params['id']; ?>">
                    <td>
                        <input name="id" type="hidden" value="<?php echo $params['id']; ?>">
                        <input name="name" type="text" value="<?php echo $params['name']; ?>" placeholder="Параметр">
                        <?php $yet_conf_array[] = $params['name']; ?>
                    </td>
                    <td>
                        <input name="value" type="text" value="<?php echo $params['value']; ?>" placeholder="Значение">
                    </td>
                    <td>
                        <textarea name="value" placeholder="Комментарий"><?php echo $params['comment']; ?></textarea>
                    </td>
                </tr>
            <?php
            }
            foreach($conf_array as $name => $comment){
                if(!in_array($name, $yet_conf_array)){
                    ?>
                    <tr class="c_new">
                        <td>
                            <input name="id" type="hidden" value="add" style="width: 250px;">
                            <input name="name" type="text" value="<?php echo $name; ?>" placeholder="Параметр">
                        </td>
                        <td>
                            <input name="value" type="text" value="" placeholder="Значение">
                        </td>
                        <td>
                            <textarea name="value" placeholder="Комментарий"><?php echo $comment; ?></textarea>
                        </td>
                    </tr>
                <?php
                }
            }
            ?>
            <tr class="c_new plus">
                <td>
                    <button class="addtr">+</button>
                    <input name="id" type="hidden" value="add">
                    <input style="width: 220px;" name="name" type="text" value="" placeholder="Параметр">
                </td>
                <td>
                    <input name="value" type="text" value="" placeholder="Значение">
                </td>
                <td>
                    <textarea name="value" placeholder="Комментарий"></textarea>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    Если Вы хотите отключить параметр, не удаляя его из базы, поставьте символ # в начале поля "Параметр".
                </td>
            </tr>
        </tfoot>
    </table>

    <table id="e_upd" class="conf_block">
        <tbody>
            <tr>
                <th colspan="3">Обновление</th>
            </tr>
            <tr>
                <td>Параметр</td>
                <td>Значение</td>
                <td>Комментарий</td>
            </tr>
            <?php
            foreach($conf_list['updates'] as $params){
                ?>
                <tr id="u_<?php echo $params['id']; ?>">
                    <td>
                        <input name="id" type="hidden" value="<?php echo $params['id']; ?>">
                        <input name="name" type="text" value="<?php echo $params['name']; ?>" placeholder="Параметр">
                    </td>
                    <td>
                        <input name="value" type="text" value="<?php echo $params['value']; ?>" placeholder="Значение">
                    </td>
                    <td>
                        <textarea name="value" placeholder="Комментарий"><?php echo $params['comment']; ?></textarea>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr class="u_new plus">
                <td>
                    <button class="addtr">+</button>
                    <input name="id" type="hidden" value="add">
                    <input style="width: 220px;" name="name" type="text" value="" placeholder="Параметр">
                </td>
                <td>
                    <input name="value" type="text" value="" placeholder="Значение">
                </td>
                <td>
                    <textarea name="value" placeholder="Комментарий"></textarea>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="r_col col">
    <table id="e_set" class="conf_block">
        <tbody>
            <tr>
                <th colspan="3">Настройки</th>
            </tr>
            <tr>
                <td>Параметр</td>
                <td>Значение</td>
                <td>Комментарий</td>
            </tr>
            <?php
            foreach($conf_list['settings'] as $params){
                ?>
                <tr id="s_<?php echo $params['id']; ?>">
                    <td>
                        <input name="id" type="hidden" value="<?php echo $params['id']; ?>">
                        <input name="name" type="text" value="<?php echo $params['name']; ?>" placeholder="Параметр">
                    </td>
                    <td>
                        <input name="value" type="text" value="<?php echo $params['value']; ?>" placeholder="Значение">
                    </td>
                    <td>
                        <textarea name="value" placeholder="Комментарий"><?php echo $params['comment']; ?></textarea>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr class="s_new plus">
                <td>
                    <button class="addtr">+</button>
                    <input name="id" type="hidden" value="add">
                    <input style="width: 220px;" name="name" type="text" value="" placeholder="Параметр">
                </td>
                <td>
                    <input name="value" type="text" value="" placeholder="Значение">
                </td>
                <td>
                    <textarea name="value" placeholder="Комментарий"></textarea>
                </td>
            </tr>
        </tbody>
    </table>

    <table id="e_fiwa" class="conf_block">
        <tbody>
            <tr>
                <th colspan="3">Прошивка</th>
            </tr>
            <tr>
                <td>Параметр</td>
                <td>Значение</td>
                <td>Комментарий</td>
            </tr>
            <?php
            foreach($conf_list['firmwares'] as $params){
                ?>
                <tr id="f_<?php echo $params['id']; ?>">
                    <td>
                        <input name="id" type="hidden" value="<?php echo $params['id']; ?>">
                        <input name="name" type="text" value="<?php echo $params['name']; ?>" placeholder="Параметр">
                    </td>
                    <td>
                        <input name="value" type="text" value="<?php echo $params['value']; ?>" placeholder="Значение">
                    </td>
                    <td>
                        <textarea name="value" placeholder="Комментарий"><?php echo $params['comment']; ?></textarea>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr class="f_new plus">
                <td>
                    <button class="addtr">+</button>
                    <input name="id" type="hidden" value="add">
                    <input style="width: 220px;" name="name" type="text" value="" placeholder="Параметр">
                </td>
                <td>
                    <input name="value" type="text" value="" placeholder="Значение">
                </td>
                <td>
                    <textarea name="value" placeholder="Комментарий"></textarea>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br>
<button class="save">Сохранить</button>
<script>
    var desc = Date.now();
    addTr();
    $('.save').on('click', function(){
        var $conf_id = location.hash.split('=')[1];
        var $conf_name = $('input[name=config_name]').val();
        $('tr').each(function() {
            var $n = $(this).children('td')[0];
            var id = $($($n).children('input')[0]).val();
            if (id == '') {
                id = 'add';
            }
            var name = $($($n).children('input')[1]).val();
            var value = $($(this).children('td')[1]).children('input').val();
            var comment = $($(this).children('td')[2]).children('textarea').val();
            var config = {};
            var table = $(this).parent('tbody').parent('table').attr('id');
            if (name != '' && name != undefined && value != '' && value != undefined) {
                config['conf_id'] = $conf_id;
                config['id'] = id;
                config['name'] = name;
                config['value'] = value;
                config['comment'] = comment;
                config['conf_name'] = $conf_name;
                config['date'] = desc;
                if (table == 'e_conf') {
                    config['table'] = 'conf';
                }
                else if (table == 'e_upd') {
                    config['table'] = 'update';
                }
                else if (table == 'e_set') {
                    config['table'] = 'setting';
                }
                else if (table == 'e_fiwa') {
                    config['table'] = 'firmware';
                }
                try {
                    $.ajax({
                        type: 'POST',
                        url: 'vermax.php',
                        data: {save_conf: config},
                        success: function (data) {
                            console.log(data);
                            if (data != '') {
                                location.hash = 'config=' + data;
                                console.log(data);
                                request("Конфигурация сохранена", "message");
                            }
                        },
                        error: function (xhr, str) {
                            alert('Возникла ошибка: ' + xhr.responseCode);
                        }
                    });
                }catch (e){
                    console.log(123);
                }
            }
            else if (name == '' && value == '' && id != '' && id != 'add') {
                config['id'] = id;
                if (table == 'e_conf') {
                    config['table'] = 'conf';
                }
                else if (table == 'e_upd') {
                    config['table'] = 'update';
                }
                else if (table == 'e_set') {
                    config['table'] = 'setting';
                }
                else if (table == 'e_fiwa') {
                    config['table'] = 'firmware';
                }
                $.ajax({
                    type: 'POST',
                    url: 'vermax.php',
                    data: {rm_conf: config},
                    success: function (data) {
                        data = jQuery.parseJSON(data);
                        console.log(data);
                        request("Конфигурация сохранена", "message");
                    },
                    error: function (xhr, str) {
                        alert('Возникла ошибка: ' + xhr.responseCode);
                    }
                });
            }
        });
        location.reload(true);
    });
</script>