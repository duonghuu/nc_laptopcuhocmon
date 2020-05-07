<div class="drag-wrapper">
    <div data-drag="data-drag" class="thing">
        <a class="drag_messenger_button toby_tooltip" title="Chat Facebook" data-toggle="tooltip">
            <div class="circle facebook-messenger-avatar blink">
                <img title="messenger-avatar" class="facebook-messenger-avatar" src="assets/messenger/facebook-messenger.svg">
            </div>
        </a>
        <div class="content">
            <div class="inside" id="fbmessenger_content">
                <div class="arrow"></div>
                <ul class="ChatLog" id="chat_text">
                    <li class="ChatLog__entry">
                        <img title="ChatLog__avatar" class="ChatLog__avatar" src="<?=_upload_photo_l.$logo['photo']?>" />
                        <p class="ChatLog__message">
                            Chào bạn!
                            <time class="ChatLog__timestamp">1 minutes ago</time>
                        </p>
                    </li>
                    <li class="ChatLog__entry">
                        <img title="ChatLog__avatar_fb" class="ChatLog__avatar" src="<?=_upload_photo_l.$logo['photo']?>" />
                        <p class="ChatLog__message">
                            Bạn cần Shop tự vấn hoặc hỗ trợ thêm thông tin gì không bạn ha?
                            <time class="ChatLog__timestamp">2 minutes ago</time>
                        </p>
                    </li>
                    <li class="Chat_button" id="Chat_button"></li>
                </ul>

                <div class="fb-page" data-href="<?=$row_setting['fanpage']?>" data-tabs="messages" data-width="310" data-height="270" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?=$row_setting['fanpage']?>" class="fb-xfbml-parse-ignore"><a href="<?=$row_setting['fanpage']?>">Facebook</a></blockquote></div>
            </div>
        </div>
    </div>
    <div class="magnet-zone">
        <div class="magnet"></div>
    </div>
</div>
<div id="messenger_bg"></div>