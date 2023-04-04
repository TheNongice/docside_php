<?php
    $music_topic = array(
        array("O-Zone","My ya heeee My ya hoooo My ya haha","https://youtu.be/YnopHCL1Jk8?t=53"),
        array("????","I think you know this song.","https://youtu.be/dQw4w9WgXcQ"),
        array("a-ha","take on meeee (take on me) take me onnn (take on me)","https://youtu.be/djV11Xbc914?t=54"),
        array("Vitas","Aha, aha, hahaha, hahaha-ha<br>Brlrl, brlrl, haha<br>Aha, aha, hahaha, hahaha-ha<br>Brlrl, brlrl, haha<br>Aha, aha, hahaha, hahaha-ha<br>Brlrl, brlrl, haha<br>Aha, aha, hahaha, hahaha-ha<br>Brlrl, brlrl, haha","https://youtu.be/B5-X_3_Kpww?t=45"),
        array("slcakcircus","HEYYEYAAEYAAAEYAEYAA HEYYEYAAEYAAAEYAEYAA","https://www.youtube.com/watch?v=ZZ5LpwO-An4"),
        array("Blend-A (from Blend S)","Smile Sweet....","https://www.youtube.com/watch?v=8AnHr2cT_-w"),
        array("Kana Hanazawa","Se no! (เซโน๊ะ!)","https://www.youtube.com/watch?v=uKxyLmbOc0Q"),
        array("Imagine Dragons","I-I-I got this feeling, yeah, you know<br>Where I'm losing all control<br>'Cause there's magic in my bones","https://www.youtube.com/watch?v=TO-_3tck2tg"),
        array("Stray Kids","Guess song! I think you know when listen it.","https://www.youtube.com/watch?v=mcIVRlw23eY"),
        array("Sia","One, two, three, one, two, three, drink<br>One, two, three, one, two, three, drink<br>Throw 'em back 'til I lose count<br>อายยยย มานัสวี เอามานะอีหี้ เอามานะอีหี้ฮี","https://www.youtube.com/watch?v=2vjPBrBU-TM&t=33s"),
        array("Trio","Da, da, da<br>Da, da, da<br>Da, da, da<br>Da, da, da","https://youtu.be/xqTBlft8gQA?t=49"),
        array("Kids Superstars","Meow, meow meow, meow meow meow meow meow","https://www.youtube.com/watch?v=YBdekGSC68A"),
        array("Michael Jackson","Awwwwwww","https://youtu.be/h_D3VFfhvs4?t=66"),
        array("Eminem","I'ma kill you! Lyrics comin at you at supersonic speed<br> J.J.Fad Uh,summa-lumma,dooma-lumma,posdjf0qu0-r724387rufieofiuIO&@#*&82irhi2hf","https://youtu.be/XbGs_qK2PQA?t=259"),
        array("Carabao","Made in __somewhere please answer by yourself__","https://www.youtube.com/watch?v=z4PnoU9kzyg"),
        array("Sek Loso","Yak den khao pai bok wa ____answer by yourself____","/bin/sek_loso_somsan.mp4"),
        array("AC/DC","When listen to this music. <strong>You will must miss Professor Dang</strong>","https://www.youtube.com/watch?v=pAgnJDJN4VA")
    );  
    $random_music=array_rand($music_topic,1);
    $topic = "ของ ".$music_topic[$random_music][0];
    $story = $music_topic[$random_music][1];
    $links = $music_topic[$random_music][2];
    