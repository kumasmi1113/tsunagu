$(function(){
  'use strict'; //より厳密なエラーチャック
  $(document).on('click','#topdelete', function() {
    // idを取得
    //#topdelete要素の親要素tdのdata属性のidを引っ張ってくる
    var id = $(this).parents('tr').data('id');
    // ajax処理
    if (confirm('本当に削除しますか？')) {
      $.post('_ajax.php', {
        id: id,
        mode: 'delete',
      }, function() {
        $('#dell_' + id).fadeOut(800);
        // フラッシュメッセージ表示
        //appendは指定した要素内の最後に引数のコンテンツを追加する
        $('.deletearea').append('<div class="flash_message"><p>削除しました</p></div>');
        $('.flash_message').fadeIn(4000);
        $('.flash_message').fadeOut(2000, function(){
          //複数削除した場合にフラッシュメッセージが何度も出てこないように
            $('.deletearea .flash_message').remove();
          });
      });
    }
  });

//ユーザー削除(uppdate)
  $(document).on('click','#userdelete', function() {
    // idを取得
    //#topdelete要素の親要素tdのdata属性のidを引っ張ってくる
    var id = $(this).parents('tr').data('id');
    // ajax処理
    if (confirm('本当に削除しますか？')) {
      $.post('_ajax.php', {
        id: id,
        mode: 'update',
      }, function() {
        $('#userdell_' + id).fadeOut(800);
        // フラッシュメッセージ表示
        //appendは指定した要素内の最後に引数のコンテンツを追加する
        $('.deletearea').append('<div class="flash_message"><p>削除しました</p></div>');
        $('.flash_message').fadeIn(4000);
        $('.flash_message').fadeOut(2000, function(){
          //複数削除した場合にフラッシュメッセージが何度も出てこないように
            $('.deletearea .flash_message').remove();
          });
      });
    }
  });
});
