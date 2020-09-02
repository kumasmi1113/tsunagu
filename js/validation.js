$(function(){
    //必須項目チェック(error_required)
    $(".required").blur(function(){
        if($(this).val() == ""){
            $(this).siblings('span.error_required').text("※入力必須項目です");
            $(this).addClass("errored");
        } else {
            $(this).siblings('span.error_required').text("");
            $(this).removeClass("errored");
        }
    });

    //名前入力チェック
    $("#name").blur(function(){
        if(!$(this).val().match(/^[ぁ-んァ-ヶー一-龠 　rnt]+$/)){
            $(this).siblings('span.error_name').text("※正しく入力してください");
            $(this).addClass("errored");
        } else {
            $(this).siblings('span.error_name').text("");
            $(this).removeClass("errored");
        }
    });

    //名前入力チェック
    $("#company").blur(function(){
        if(!$(this).val().match(/^[ぁ-んァ-ヶー一-龠 　rnt]+$/)){
            $(this).siblings('span.error_name').text("※正しく入力してください");
            $(this).addClass("errored");
        } else {
            $(this).siblings('span.error_name').text("");
            $(this).removeClass("errored");
        }
    });

    //電話番号入力チェック
    $("#tel").blur(function(){
        if(!$(this).val().match(/^[0-9]+$/)){
            $(this).siblings('span.error_tel').text("※正しく入力してください");
            $(this).addClass("errored");
        } else {
            $(this).siblings('span.error_tel').text("");
            $(this).removeClass("errored");
        }
    });

    //メールアドレス入力チェック
    $("#mail").blur(function(){
        if(!$(this).val().match(/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/)){
            $(this).siblings('span.error_mail').text("※メールアドレスを正しく入力してください");
            $(this).addClass("errored");
        } else {
            $(this).siblings('span.error_mail').text("");
            $(this).removeClass("errored");
        }
    });


    //パスワード入力チェック
    $("#pass").blur(function(){
        if(!$(this).val().match(/^[a-zA-Z0-9]+$/)){
            $(this).siblings('span.error_pass').text("※パスワードは半角英数のみ入力可能です。");
            $(this).addClass("errored");
        } else {
            $(this).siblings('span.error_pass').text("");
            $(this).removeClass("errored");
        }
    });


    //フリガナ入力チェック
    $("#huri").blur(function(){
        if(!$(this).val().match(/^[ア-ン゛゜ァ-ォャ-ョー「」、]+$/)){
            $(this).siblings('span.error_huri').text("※フリガナは全角カタカナで入力してください");
            $(this).addClass("errored");
        } else {
            $(this).siblings('span.error_huri').text("");
            $(this).removeClass("errored");
        }
    });

    //名前入力チェック
    $("#enname").blur(function(){
        if(!$(this).val().match(/^[ぁ-んァ-ヶー一-龠 　rnt]+$/)){
            $(this).siblings('span.error_enname').text("※正しく入力してください");
            $(this).addClass("errored");
        } else {
            $(this).siblings('span.error_enname').text("");
            $(this).removeClass("errored");
        }
    });


})
