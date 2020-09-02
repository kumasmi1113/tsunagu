<?php
if (mb_send_mail('kumasmi1113@gmail.com', 'EST SUBJECT', 'EST BODY')) {
echo '送信完了';
} else {
echo '送信失敗';
}
