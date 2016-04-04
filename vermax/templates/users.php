<table class="users_t">
    <tbody>
        <tr>
            <td>IP</td>
            <td>MAC</td>
            <td>Пин-код</td>
            <td>Конфиг</td>
            <td></td>
        </tr>
        <?php
        foreach($users as $user){
            ?>
            <tr id="user_<?php echo $user['id']; ?>">
                <td><?php echo $user['ip']; ?></td>
                <td><?php echo $user['mac']; ?></td>
                <td>
                    <input class="u_p" type="text" value="<?php echo $user['pass']; ?>">
                </td>
                <td>
                    <select class="u_c">
                        <?php
                        foreach($configs as $config){
                            ?>
                            <option value="<?php echo $config['id']; ?>" <?php echo $user['conf'] == $config['id'] ? 'selected' : ''; ?>><?php echo $config['name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td width="83px">
                    <button class="user_save">Сохранить</button>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<script>
    $('.u_p').on('keyup', function(){
        $(this).parent('td').next('td').next('td').children('button').show();
    });
    $('.u_c').on('change',  function(){
        $(this).parent('td').next('td').children('button').show();
    });
    $('.user_save').on('click', function(){
        var $tr = $(this).parent('td').parent('tr');
        config = {};
        config['id'] = $tr.attr('id').split('_')[1];
        config['mac'] = $($tr.children('td')[1]).text();
        config['pass'] = $($tr.children('td')[2]).children('input').val();
        config['conf'] = $($tr.children('td')[3]).children('select').val();
        try {
            $.ajax({
                type: 'POST',
                url: 'vermax.php',
                data: {set_users: config},
                success: function (data) {
                    console.log(data);
                    if (data != '') {
                        console.log(data);
                        request("Пользователь сохранен", "message");
                    }
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            });
        }catch (e){
            console.log(e);
        }
        $(this).hide();
    });

</script>