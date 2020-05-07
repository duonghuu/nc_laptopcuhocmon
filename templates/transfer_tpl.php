<HTML>
    <HEAD>
        <TITLE>Thông báo</TITLE>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="REFRESH" content="4; url=<?=$page_transfer?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </HEAD>
    <style type="text/css">
        body 
        {
            font: 12px/20px 'Lucida Grande', Verdana, sans-serif;
            color: #404040;
            background: #343137;
        }
        .container 
        {
            margin: 20px auto;
            max-width: 500px;
            width:98%;
        }
        .container .notif 
        {
            margin: 10px 0;
        }
        .notif 
        {
            position: relative;
            padding: 25px 30px;
            min-height: 50px;
            line-height: 22px;
            background: white;
            border-radius: 2px;
        }
        .notif p 
        {
            color: #666;
            margin:0px;
            text-align:center;
        }
        .notif-title 
        {
            margin: 0 0 5px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }
    </style>
<BODY>
    <div class="container">
        <section class="notif">
            <p><?=$showtext?></p>
            <p>-----------------------------------------</p>
            <p>(<a href="<?=$page_transfer?>">Click vào đây nếu bạn không muốn đợi lâu </a>)</p>
        </section>
    </div>
</BODY>
</HTML>