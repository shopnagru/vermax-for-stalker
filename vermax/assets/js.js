function hash(){
    hash = location.hash;
    if(hash == "#changelog") {
        changelog();
    }
    else if(hash == "#docs"){
        documentation();
    }
    else if(hash == '#users'){
        getUsers();
    }
    else if(hash != ''){
        hash = hash.split('=');
        if(hash[0] == "#config"){
            getConf(hash[1]);
        }
    }
}

function changelog(){
    $('#content').show();
    $('iframe').hide();
    jQuery.get('/vermax/assets/ch_log.txt', function(data){
        $("#content").html("<pre>" + data + "</pre>");
        location.hash = 'changelog';
    });
}

function documentation(){
    $('#content').show();
    $('iframe').hide();
    jQuery.get('/vermax/assets/docs.html', function(data){
        $("#content").html("<pre>" + data + "</pre>");
        location.hash = 'docs';
    });
}

function request(data, type){
    var $req = $('#request');
    if(type == "message"){
        $req.css('background', '#0868AB');
    }
    else if(type == "alert"){
        $req.css('background', 'rgb(223, 130, 22)');
    }
    else if(type == "error"){
        $req.css('background', 'rgb(203, 42, 42)');
    }
    else{
        $req.css('background', '#0868AB');
    }
    $req.html(data);
    $req.css('display', 'block');
    setTimeout(function(){$('#request').css('display', 'none')}, 2000);
}

function getConf(config){
    var $con = $('#content');
    $con.show();
    $('iframe').hide();
    $con.html("Загрузка конфигурации. Ожидайте");
    request("Загрузка конфигурации. Ожидайте", "message");
    $.ajax({
        type: 'POST',
        url: 'vermax.php',
        data: {get_conf: config},
        success: function(data) {
            location.hash = 'config=' + config;
            if(data == 'Off'){
                request(data, "alert");
            }
            else{
                $('#content').html(data);
                request("Конфигурация загружена", "message");
            }
        },
        error: function(xhr, str){
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    });
}

function getUsers(){
 var $con = $('#content');
    $con.show();
    $('iframe').hide();
    $con.html("Загрузка приставок. Ожидайте");
    request("Загрузка приставок. Ожидайте", "message");
    $.ajax({
        type: 'POST',
        url: 'vermax.php',
        data: {get_users: 1},
        success: function(data) {
            location.hash = 'users';
            $('#content').html(data);
            request("Приставки загружены", "message");
        },
        error: function(xhr, str){
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    });

}

function addTr() {
    $('.addtr').on('click', function () {
        $tr = $(this).parent().parent();
        $cl = $tr.clone();
        $cl.children().children('input').each(function(){
            $(this).val('');
        });
        $cl.appendTo($tr.parent());
        $(this).next('input').css('width', '250px');
        $(this).parent('td').parent('tr').removeClass('plus');
        $(this).remove();
        $('.addtr').off('click');
        addTr();
    });
    $('.plus').children('td').children('input').on('keypress', function(){
        $('.plus').children('td').children('input').off('keypress');
        $($(this).parent('td').parent('tr').children('td')[0]).children('button').click();
        addTr();
    });
}

function portal(){
    $('iframe').show();
    $('#content').hide();
    location.hash = '';
}