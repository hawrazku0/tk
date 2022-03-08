<?php
ob_start();
/*
creator : @Developer_P_H_P
channels : @PowerfulTM,@IranTM
*/
$infor=json_decode(file_get_contents("config.json"));

define('API_KEY',"5132001050:AAG4pI9V9XFv6AHElgds9Kn2http2sUg4jg");
 
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$up=json_decode(file_get_contents('php://input'));
$sudo = 2115353622;
$caption=$up->message->caption;
$fwd_id=$up->message->reply_to_message->forward_from->id;
$first_name=$up->message->from->first_name;
$setting=json_decode(file_get_contents("setting.json"),true);
$json=json_decode(file_get_contents("dasturat.json"),true);
$last_name=$up->message->from->last_name;
$msg_id=$up->message->message_id;
$username=$up->message->from->username;
$chat_id=$up->message->chat->id;
$from_id=$up->message->from->id;
if(!file_exists("sudo.txt")){
  file_put_contents("sudo.txt","empty");
}
$vaziyat=file_get_contents("sudo.txt");
if(!file_exists("member.json")){
  file_put_contents("member.json",json_encode([$sudo]));
}
if(!file_exists("bakhsh.txt")){
  file_put_contents("bakhsh.txt","empty");
}
if(!file_exists("profile.txt")){
  file_put_contents("profile.txt","پڕۆفایل هیچی تێدانیە.");
}
if(!file_exists("setting.json")){
  file_put_contents("setting.json",json_encode(["sticker"=>"no","video"=>"no","photo"=>"no","videoNote"=>"no","audio"=>"no","voice"=>"no","document"=>"no"]));
}
if(!file_exists("dasturat.json")){
  file_put_contents("dasturat.json",json_encode(["empty"=>"yes"]));
}
if(!file_exists("start.txt")){
  file_put_contents("start.txt","بەخێربێیت بۆ بۆتی دوگمەکان
  ئەم بۆتە لەلایەن ڕێکخەری بۆتەوە ڕێکخراوە 👇
🆔 @RekXaryBoT
✊️ تۆش بۆتەکەت ڕێک بخە لەلایەن ڕێکخەری بۆتەوە بە تایبەتمەندی ناوازەوە 
");
}
if(!file_exists("block.txt")){
  file_put_contents("block.txt","block");
}
$text=$up->message->text;
$member=array_unique(json_decode(file_get_contents("member.json"),true));
if(isset($up->message)){
  if($from_id==$sudo){
    if($text=="فەشەلکردنەوە" and $vaziyat!="empty"){
       if($vaziyat=="pasokhzirdastur"){
        $commonds=$json[file_get_contents("bakhsh.txt")]["commonds"];
        
        foreach($json as $key=>$value){
          if(isset($json[$key]["commonds"])){
            if(array_search(file_get_contents("dastur.txt"),$commonds)!=false){
              unset($json[$key]["commonds"][array_search(file_get_contents("dastur.txt"),$commonds)+0]);
            }
          }
        }
        unset($json[file_get_contents("dastur.txt")]);
        $json=json_encode($json);
        file_put_contents("dasturat.json","$json");
        file_put_contents("sudo.txt","empty");
        file_put_contents("bakhsh.txt","empty");
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"کردارەکە هەڵوەشێنرایەوە."
        ]);
     }else{
      file_put_contents("sudo.txt","empty");
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"_کردارەکە هەڵوەشێنرایەوە._",
        "parse_mode"=>"markdown",
        "reply_markup"=>json_encode(["remove_keyboard"=>true])
      ]);
      }
    }elseif($vaziyat=="resetbot"){
      if($text=="بەڵێ"){
        unlink("start.txt");
        unlink("profile.txt");
        unlink("dasturat.json");
        unlink("setting.json");
        unlink("dastur.txt");
        unlink("bakhsh.txt");
        unlink("block.txt");
        file_put_contents("sudo.txt","empty");
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"بەسەرکەوتوی سڕانەوە 🗑",
          "reply_markup"=>json_encode(["remove_keyboard"=>true])
        ]);
      }else{
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"یەکێک لە هەڵبژاردەکانی خوارەوە هەڵبژێرە."
        ]);
      }
    }elseif($vaziyat=="hazfdastur"){
     
 $json=json_decode(file_get_contents("dasturat.json"),true);    
 if(isset($json[$text]) && $text!="empty"){
        unset($json[$text]);
        foreach($json as $key=>$value){
        if(isset($json[$key]["commonds"])){
   $commonds=$json[$key]["commonds"];
   unset($json[$key]["commonds"][array_search($text,$commonds)+0]);
 }}
        $json=json_encode($json);
        file_put_contents("dasturat.json","$json");
        file_put_contents("sudo.txt","empty");
        bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"_دووگمەکە سڕایەوە 🗑_",
        "parse_mode"=>"markdown",
        "reply_markup"=>json_encode(["remove_keyboard"=>true])
      ]);
      }else{
        bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"_ئەم دوگمە بەردەست نییە._",
        "parse_mode"=>"markdown"
      ]);
      }
    }elseif($vaziyat=="forward"){
      foreach($member as $key=>$value){
        bot("forwardMessage",[
          "chat_id"=>$value,
          "from_chat_id"=>$chat_id,
          "message_id"=>$msg_id
        ]);
      }
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا بۆ هەموو بەکارهێنەرەکان._",
        "parse_mode"=>"markdown",
        "reply_markup"=>json_encode(["remove_keyboard"=>true])
      ]);
      file_put_contents("sudo.txt","empty");
    }elseif($vaziyat=="forward2"){
      if(isset($up->message->text)){
        foreach($member as $key=>$value){
        bot("sendMessage",[
          "chat_id"=>$value,
          "text"=>$text
        ]);
      }
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا بۆ هەموو بەکارهێنەرەکان._",
        "parse_mode"=>"markdown",
        "reply_markup"=>json_encode(["remove_keyboard"=>true])
      ]);
      file_put_contents("sudo.txt","empty");
      }elseif(isset($up->message->photo)){
        $up2=json_decode(file_get_contents("php://input"),true);
        $file_id=$up2["message"]["photo"][0]["file_id"];
        foreach($member as $key=>$value){
        bot("sendphoto",[
          "chat_id"=>$value,
          "photo"=>$file_id,
          "caption"=>$caption
        ]);
      }
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا بۆ هەموو بەکارهێنەرەکان._",
        "parse_mode"=>"markdown",
        "reply_markup"=>json_encode(["remove_keyboard"=>true])
      ]);
      file_put_contents("sudo.txt","empty");
      }elseif(isset($up->message->audio)){
        $file_id=$up->message->audio->file_id;
        foreach($member as $key=>$value){
        bot("sendaudio",[
          "chat_id"=>$value,
          "caption"=>$caption,
          "audio"=>$file_id
        ]);
      }
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا بۆ هەموو بەکارهێنەرەکان._",
        "parse_mode"=>"markdown",
        "reply_markup"=>json_encode(["remove_keyboard"=>true])
      ]);
      file_put_contents("sudo.txt","empty");
      }elseif(isset($up->message->document)){
        $file_id=$up->message->document->file_id;
        foreach($member as $key=>$value){
        bot("senddocument",[
          "chat_id"=>$value,
          "document"=>$file_id,
          "caption"=>$caption
        ]);
      }
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا بۆ هەموو بەکارهێنەرەکان._",
        "parse_mode"=>"markdown",
        "reply_markup"=>json_encode(["remove_keyboard"=>true])
      ]);
      file_put_contents("sudo.txt","empty");
      }elseif(isset($up->message->video_note)){
        $file_id=$up->message->video_note->file_id;
        foreach($member as $key=>$value){
        bot("sendvideonote",[
          "chat_id"=>$value,
          "video_note"=>$file_id
        ]);
      }
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا بۆ هەموو بەکارهێنەرەکان._",
        "parse_mode"=>"markdown",
        "reply_markup"=>json_encode(["remove_keyboard"=>true])
      ]);
      file_put_contents("sudo.txt","empty");
      }elseif(isset($up->message->video)){
        $file_id=$up->message->video->file_id;
        foreach($member as $key=>$value){
        bot("sendvideo",[
          "chat_id"=>$value,
          "video"=>$file_id,
          "caption"=>$caption
        ]);
      }
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا بۆ هەموو بەکارهێنەرەکان._",
        "parse_mode"=>"markdown",
        "reply_markup"=>json_encode(["remove_keyboard"=>true])
      ]);
      file_put_contents("sudo.txt","empty");
      }elseif(isset($up->message->sticker)){
        $file_id=$up->message->sticker->file_id;
        foreach($member as $key=>$value){
        bot("sendsticker",[
          "chat_id"=>$value,
          "sticker"=>$file_id
        ]);
      }
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا بۆ هەموو بەکارهێنەرەکان._",
        "parse_mode"=>"markdown",
        "reply_markup"=>json_encode(["remove_keyboard"=>true])
      ]); file_put_contents("sudo.txt","empty");
      }elseif(isset($up->message->voice)){
        $file_id=$up->message->voice->file_id;
        foreach($member as $key=>$value){
        bot("sendvoice",[
          "chat_id"=>$value,
          "voice"=>$file_id,
          "caption"=>$caption
        ]);
      }
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا بۆ هەموو بەکارهێنەرەکان._",
        "parse_mode"=>"markdown",
        "reply_markup"=>json_encode(["remove_keyboard"=>true])
      ]);
      file_put_contents("sudo.txt","empty");
      }
    }elseif($vaziyat=="deletemenu"){
      if(isset($json[$text])){
        unset($json[$text]);
        foreach($json as $key=>$value){
          if(isset($json[$key]["commonds"])){
            $commonds=$json[$key]["commonds"];
            if(array_search($text,$commonds)!=false){
              unset($json[$key]["commonds"][array_search($text,$commonds)+0]);
              $json[$key]["commonds"]=array_values($json[$key]["commonds"]);
            }
          }
        }
       $json=json_encode($json);
       file_put_contents("dasturat.json","$json"); file_put_contents("sudo.txt","empty");
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"بەش یان لیستی لاوەکی سڕایەوە 🗑",
          "reply_markup"=>json_encode(["remove_keyboard"=>true])
        ]);
      }else{
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"ئەم بەش یان لیستی لاوەکی بەردەست نیە."
        ]);
      }
    }elseif($vaziyat=="createmenu"){
      if(isset($up->message->text)){
        if(isset($json[$text])){
          bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"ئەم دوگمە یان بەشە پێشتر بوونی هەیە."
        ]);
        }else{
          $json[$text]["type"]="menu";
          $json[$text]["commonds"]=array("گەڕانەوە بۆ لیستی سەرەکی");
          $json=json_encode($json);
          file_put_contents("sudo.txt","empty");
          file_put_contents("dasturat.json","$json");
          bot("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>"بەشەکە دروست کراوە و دەتوانیت لە بەشی بەڕێوەبردنی بەش بەڕێوەیببەیت.",
            "reply_markup"=>json_encode(["remove_keyboard"=>true])
          ]);
        }
      }else{
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"دەق بنێرە ."
        ]);
      }
    }elseif($vaziyat=="profile"){
      if(isset($up->message->text)){
        bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_پەیامی پرۆفایل خەزنکرا._",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["remove_keyboard"=>true])
        ]);
        file_put_contents("sudo.txt","empty");
        file_put_contents("profile.txt","$text");
      }else{
        bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_نامەکە دەبێت تەنها دەقی تێدابێت._",
          "parse_mode"=>"markdown"
        ]);
      }
    }elseif($vaziyat=="dasturjadid"){
      $json=json_decode(file_get_contents("dasturat.json"),true);
      if(isset($up->message->text)){
        if(!isset($json[$text]) && $text!="empty" && $text!="/start" && $text!="پڕۆفایل"){
          file_put_contents("dastur.txt","$text");
          file_put_contents("sudo.txt","pasokh");
          bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_ئەوە بنێرە کەدەتەوێت بەداگرتنی دوگمە بنێردرێت_",
          "parse_mode"=>"markdown"
        ]);
        }else{
          bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_ئەم دوگمە پێشتر بوونی هەیە._",
          "parse_mode"=>"markdown"
        ]);
        }
      }else{
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_دووگمە دەبێت تەنها دەق بێت._",
          "parse_mode"=>"markdown"
        ]);
      }
    }elseif($vaziyat=="pasokh" or $vaziyat=="pasokhzirdastur"){
      if(isset($up->message->text)){
   $json=json_decode(file_get_contents("dasturat.json"),true);
          $json[file_get_contents("dastur.txt")]["text"]="$text";
          $json=json_encode($json);
          file_put_contents("dasturat.json","$json");
         file_put_contents("sudo.txt","empty");
            bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_دوگمە زیاد کرا_",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["remove_keyboard"=>true])
        ]);
      }elseif(isset($up->message->photo)){
        $json=json_decode(file_get_contents("dasturat.json"),true);
        $up2=json_decode(file_get_contents("php://input"),true);
        $json[file_get_contents("dastur.txt")]["file_id"]=$up2["message"]["photo"][0]["file_id"];
        $json[file_get_contents("dastur.txt")]["caption"]="$caption";
        $json[file_get_contents("dastur.txt")]["type"]="photo";
        $json=json_encode($json);
        file_put_contents("dasturat.json","$json");
         file_put_contents("sudo.txt","empty");

            bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_دوگمە زیاد کرا_",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["remove_keyboard"=>true])
        ]);
      }elseif(isset($up->message->video)){
        $json=json_decode(file_get_contents("dasturat.json"),true);
        $json[file_get_contents("dastur.txt")]["caption"]="$caption";
        $json[file_get_contents("dastur.txt")]["file_id"]=$up->message->video->file_id;
        $json[file_get_contents("dastur.txt")]["type"]="video";
        $json=json_encode($json);
        file_put_contents("dasturat.json","$json");
         file_put_contents("sudo.txt","empty");

            bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_دوگمە زیاد کرا_",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["remove_keyboard"=>true])
        ]);
      }elseif(isset($up->message->video_note)){
        $json=json_decode(file_get_contents("dasturat.json"),true);
        $json[file_get_contents("dastur.txt")]["file_id"]=$up->message->video_note->file_id;
        $json[file_get_contents("dastur.txt")]["type"]="video_note";
        $json=json_encode($json);
        file_put_contents("dasturat.json","$json");
         file_put_contents("sudo.txt","empty");
            bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_دوگمە زیاد کرا_",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["remove_keyboard"=>true])
        ]);
      }elseif(isset($up->message->sticker)){
        $json=json_decode(file_get_contents("dasturat.json"),true);
        $json[file_get_contents("dastur.txt")]["file_id"]=$up->message->sticker->file_id;
        $json[file_get_contents("dastur.txt")]["type"]="sticker";
        $json=json_encode($json);
        file_put_contents("dasturat.json","$json");
         file_put_contents("sudo.txt","empty");
            bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_دوگمە زیاد کرا_",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["remove_keyboard"=>true])
        ]);
      }elseif(isset($up->message->voice)){
        $json=json_decode(file_get_contents("dasturat.json"),true);
        $json[file_get_contents("dastur.txt")]["caption"]="$caption";
        $json[file_get_contents("dastur.txt")]["file_id"]=$up->message->voice->file_id;
        $json[file_get_contents("dastur.txt")]["type"]="voice";
        $json=json_encode($json);
        file_put_contents("dasturat.json","$json");
         file_put_contents("sudo.txt","empty");
            bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_دوگمە زیاد کرا_",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["remove_keyboard"=>true])
        ]);
      }elseif(isset($up->message->audio)){
        $json=json_decode(file_get_contents("dasturat.json"),true);
        $json[file_get_contents("dastur.txt")]["caption"]="$caption";
        $json[file_get_contents("dastur.txt")]["file_id"]=$up->message->audio->file_id;
        $json[file_get_contents("dastur.txt")]["type"]="audio";
        $json=json_encode($json);
        file_put_contents("dasturat.json","$json");
         file_put_contents("sudo.txt","empty");
            bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_دوگمە زیاد کرا_",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["remove_keyboard"=>true])
        ]);
      }elseif(isset($up->message->document)){
        $json=json_decode(file_get_contents("dasturat.json"),true);
        $json[file_get_contents("dastur.txt")]["caption"]="$caption";
        $json[file_get_contents("dastur.txt")]["file_id"]=$up->message->document->file_id;
        $json[file_get_contents("dastur.txt")]["type"]="document";
        $json=json_encode($json);
        file_put_contents("dasturat.json","$json");
         file_put_contents("sudo.txt","empty");
            bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_دوگمە زیاد کرا_",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["remove_keyboard"=>true])
        ]);
      }
    }elseif($vaziyat=="zirmenu"){
      if(isset($up->message->text)){
        if(isset($json[$text])){
          bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"ئەم دوگمە یان بەشە پێشتر بوونی هەیە."
        ]);
        }else{
          $json[$text]["type"]="menu";
          $json[$text]["type2"]="zirmenu";
          $json[$text]["commonds"]=array("گەڕانەوە بۆ لیستی سەرەکی");
          $commonds=$json[file_get_contents("bakhsh.txt")]["commonds"];
          unset($commonds[array_search("گەڕانەوە بۆ لیستی سەرەکی",$commonds)+0]);
          $json[file_get_contents("bakhsh.txt")]["commonds"][count($commonds)]=$text;
          $commonds=$json[file_get_contents("bakhsh.txt")]["commonds"];
          $json[file_get_contents("bakhsh.txt")]["commonds"][count($commonds)]="گەڕانەوە بۆ لیستی سەرەکی";
          $json=json_encode($json);
          file_put_contents("bakhsh.txt","empty");
          file_put_contents("sudo.txt","empty");
          file_put_contents("dasturat.json","$json");
          bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"بەشەکە دروستکرا",
          "reply_markup"=>json_encode(["remove_keyboard"=>true])
        ]);
        }
      }else{
        bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"دەق بنێرە."
        ]);
      }
    }elseif($vaziyat=="zirdastur"){
      if(isset($up->message->text)){
        if(isset($json[$text])){
          bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"ئەم دوگمە یان بەشە پێشتر بوونی هەیە."
        ]);
        }else{
          $json[$text]["type2"]="zirdastur";
          $commonds=$json[file_get_contents("bakhsh.txt")]["commonds"];
          unset($commonds[array_search("گەڕانەوە بۆ لیستی سەرەکی",$commonds)+0]);
          $json[file_get_contents("bakhsh.txt")]["commonds"][count($commonds)]=$text;
          $commonds=$json[file_get_contents("bakhsh.txt")]["commonds"];
          $json[file_get_contents("bakhsh.txt")]["commonds"][count($commonds)]="گەڕانەوە بۆ لیستی سەرەکی";
          $json=json_encode($json);
          file_put_contents("bakhsh.txt","empty");
          file_put_contents("sudo.txt","pasokhzirdastur");
          file_put_contents("dastur.txt",$text);
          file_put_contents("dasturat.json","$json");
          bot("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>"ئێستا وەڵامدانەوەی داواکاریەکەت بنێرە."
          ]);
        }
      }else{
        bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"دەق بنێرە."
        ]);
      }
    }elseif($vaziyat=="start"){
      if(isset($up->message->text)){
        bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_نامەی فرمانی دەستپێکەر گۆڕا._",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["remove_keyboard"=>true])
        ]);
        file_put_contents("sudo.txt","empty");
        file_put_contents("start.txt","$text");
      }else{
        bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_نامەکە دەبێت تەنها دەقی تێدابێت._",
          "parse_mode"=>"markdown"
        ]);
      }
    }elseif($text=="/block" and isset($up->message->reply_to_message->forward_from->id) and $fwd_id!=$sudo){
      $file=fopen("block.txt","a");
      fwrite($file,"\n$fwd_id");
      fclose($file);
      bot("sendmessage",[
          "chat_id"=>$fwd_id,
          "text"=>"_بەکارهێنەری ڕۆبۆتەکەت بلۆک کراوە._",
          "parse_mode"=>"markdown"
        ]);
        bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_
          بەکارهێنەر $fwd_id بلۆک ._",
          "parse_mode"=>"markdown"
        ]); 
    }elseif(isset($up->message->reply_to_message) && !empty($fwd_id)){
      if(isset($up->message->text)){
        bot("sendMessage",[
          "chat_id"=>$fwd_id,
          "text"=>$text
        ]);
      }elseif(isset($up->message->photo)){
        $up2=json_decode(file_get_contents("php://input"),true);
        $file_id=$up2["message"]["photo"][0]["file_id"];
        bot("sendphoto",[
          "chat_id"=>$fwd_id,
          "caption"=>$caption,
          "photo"=>$file_id
        ]);
      }elseif(isset($up->message->video)){
        $file_id=$up->message->video->file_id;
        bot("sendvideo",[
          "chat_id"=>$fwd_id,
          "caption"=>$caption,
          "video"=>$file_id
        ]);
      }elseif(isset($up->message->video_note)){
        $file_id=$up->message->video_note->file_id;
        bot("sendvideonote",[
          "chat_id"=>$fwd_id,
          "video_note"=>$file_id
        ]);
      }elseif(isset($up->message->sticker)){
        $file_id=$up->message->sticker->file_id;
        bot("sendsticker",[
          "chat_id"=>$fwd_id,
          "sticker"=>$file_id
        ]);
      }elseif(isset($up->message->voice)){
        $file_id=$up->message->voice->file_id;
        bot("sendVoice",[
          "chat_id"=>$fwd_id,
          "caption"=>$caption,
          "voice"=>$file_id
        ]);
      }elseif(isset($up->message->audio)){
        $file_id=$up->message->audio->file_id;
        bot("sendAudio",[
          "chat_id"=>$fwd_id,
          "caption"=>$caption,
          "audio"=>$file_id
        ]);
      }elseif(isset($up->message->document)){
        $file_id=$up->message->document->file_id;
        bot("sendDocument",[
          "chat_id"=>$fwd_id,
          "caption"=>$caption,
          "document"=>$file_id
        ]);
      }
        bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا._",
          "parse_mode"=>"markdown"
        ]);
    }elseif($text=="زیادکردنی بەش➕" && file_get_contents("bakhsh.txt")!="empty"){
      file_put_contents("sudo.txt","zirmenu");
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"ناوی بەشەکە بنێرە .",
        "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>[[["text"=>"فەشەلکردنەوە"]]]])
      ]);
    }elseif($text=="زیادکردنی دوگمە➕" && file_get_contents("bakhsh.txt")!="empty"){
      file_put_contents("sudo.txt","zirdastur");
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"دوگمەکە بنێرە.",
        "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>[[["text"=>"فەشەلکردنەوە"]]]])
      ]);
    }elseif(isset($json[$text]["commonds"])){
      file_put_contents("bakhsh.txt",$text);
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"یەکێک لە هەڵبژاردەکانی خوارەوە هەڵبژێرە.",
        "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>[[["text"=>"زیادکردنی بەش➕"],["text"=>"زیادکردنی دوگمە➕"]],[["text"=>"گەڕانەوە بۆ لیستی سەرەکی"]]]])
      ]);
    }elseif($text=="گەڕانەوە بۆ لیستی سەرەکی"){
      bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_
          گەڕانەوە لە بەشی سەرەکی، دەتوانیت دووبارە فەرمانی/start بنێریت.
          _",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["remove_keyboard"=>true])]);
    }elseif($text=="/memberfile"){
      bot("sendDocument",[
        "chat_id"=>$chat_id,
        "document"=>new CurlFile("member.txt")
      ]);
    }elseif($text=="/turn off"){
      if(!is_file("lock")){
        file_put_contents("lock","");
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"بۆتەکە کوژاوەتەوە بۆ بەکارهێنەران.."
        ]);
      }else{
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"بۆت پێشتر بۆ بەکارهێنەران کوژاوە."
        ]);
      }
    }elseif($text=="/turn on"){
      if(is_file("lock")){
        unlink("lock");
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"بۆت گەڕایەوە بۆ بەکارهێنەران."
        ]);
      }else{
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"ڕۆبۆتەکە پێشتر هەڵکراوە بۆ بەکارهێنەران."
        ]);
      }
    }elseif($text=="/start"){
    file_put_contents("bakhsh.txt","empty");
      bot("sendmessage",[
          "chat_id"=>$chat_id,
          "text"=>"_چی بکەم ، بەڕێوەبەر ؟_",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["remove_keyboard"=>true,"inline_keyboard"=>[[["text"=>"ئامار 👥","callback_data"=>"amar"],["text"=>"پڕۆفایل 👤","callback_data"=>"profile"]],[["text"=>"ڕاگەیاندنی هاوردەکراو 🗣","callback_data"=>"forward"],["text"=>"لیستی بلۆک 🚫","callback_data"=>"block"]],[["text"=>"♨️ نامەی دەستپێکی بۆت ♨️","callback_data"=>"start"]],[["text"=>"✏️ڕاگەیاندنی بێ ناونیشان✏️","callback_data"=>"forward2"]],[["text"=>"دوگمە ➕","callback_data"=>"dasturjadid"],["text"=>"دوگمە ➖","callback_data"=>"hazfdastur"]],[["text"=>"بەش ➕","callback_data"=>"createmenu"],["text"=>"بەش ➖","callback_data"=>"deletemenu"]],[["text"=>"⚜ بەڕێوبەری بەش ⚜","callback_data"=>"managementmenu"]],[["text"=>"سڕینەوەی گشتی","callback_data"=>"resetbot"]],[["text"=>"✉️ ڕێکخستنەکانی داخستنی نامە ✉️","callback_data"=>"settingmsg"]]]])
        ]);
    }
  }else{
   if(!strstr(file_get_contents("block.txt"),"$from_id")){
   if(!is_file("lock")){
    if(!isset($up->message->forward_from) && !isset($up->message->forward_from_chat)){
    $json=json_decode(file_get_contents("dasturat.json"),true);
      if($text=="فەشەلکردنەوە" && is_file("$from_id.txt")){
      unlink("$from_id.txt");
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"کردارەکە هەڵوەشێنرایەوە.",
        "reply_markup"=>json_encode(["remove_keyboard"=>true])
      ]);
    }elseif(is_file("$from_id.txt")){
      if(isset($up->message->contact)){
        $user_id=$up->message->contact->user_id;
        if($user_id==$from_id){
          bot("forwardMessage",[
            "chat_id"=>$sudo,
            "from_chat_id"=>$chat_id,
            "message_id"=>$msg_id
          ]);
          bot("sendMessage",[
            "text"=>"چاوەرێی وەڵامدانەوەی بەڕێوەبەر بکە.",
            "chat_id"=>$chat_id,
            "reply_markup"=>json_encode(["remove_keyboard"=>true])
          ]);
          unlink("$from_id.txt");
        }else{
          bot("sendMessage",[
            "text"=>"ئەم ڕەسەنایەتیە هی تۆ نییە، تکایە ناسنامەکەت بسەلمێنە.",
            "chat_id"=>$chat_id
          ]);
        }
      }else{
        bot("sendMessage",[
            "text"=>" ناسنامەکەت بسەلمێنە.",
            "chat_id"=>$chat_id
          ]);
      }
    }elseif($text=="/start" or $text=="گەڕانەوە بۆ لیستی سەرەکی"){
        $start=str_replace("userid","$from_id",file_get_contents("start.txt"));
        $start=str_replace("username","$username",$start);
        $start=str_replace("firstname","$first_name",$start);
        $start=str_replace("lastname","$last_name",$start);
        $list=array();
        $list[0]=array(array("text"=>"پڕۆفایل"));
        $arrayjs=json_decode(file_get_contents("dasturat.json"),true);
        unset($arrayjs["empty"]);
        $n=0;
        foreach($arrayjs as $key=>$value){
        if($arrayjs[$key]["type2"]!="zirdastur" and $arrayjs[$key]["type2"]!="zirmenu"){
          $n++;
          $list[$n]=array(array("text"=>"$key"));}
        }
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"$start",
          "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>$list])
        ]);
        if(array_search($from_id,$member)===false){
          array_push($member,$from_id);
          $json=json_encode($member);
          file_put_contents("member.json","$json");
        }
      }elseif($text=="/taidhoviyat"){
      bot("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>"کرتە بکە لەسەر بژاردەی ڕەسەنایەتی بۆ سەلماندنی ناسنامەکە.",
        "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>[[["text"=>"ڕەسەنایەتی","request_contact"=>true]],[["text"=>"فەشەلکردنەوە"]]]])
      ]);
      file_put_contents("$from_id.txt","empty");
    }elseif($text=="پڕۆفایل"){
        $profile=file_get_contents("profile.txt");
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"$profile"
        ]);
      }elseif(isset($json[$text]) && $text!="empty"){
        if(isset($json[$text]["text"])){
          bot("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>$json[$text]["text"],
            "parse_mode"=>"html"
          ]);
        }elseif($json[$text]["type"]=="menu"){
          $array=$json[$text]["commonds"];
          $list=array();
          foreach($array as $key=>$value){
            $list[$key]=array(array("text"=>"$value"));
          }
          bot("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>"یەکێک لە هەڵبژاردەکانی خوارەوە هەڵبژێرە.",
            "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>$list])
          ]);
        }elseif($json[$text]["type"]=="sticker"){
          bot("sendSticker",[
            "chat_id"=>$chat_id,
            "sticker"=>$json[$text]["file_id"]
          ]);
        }elseif($json[$text]["type"]=="video"){
          bot("sendVideo",[
            "chat_id"=>$chat_id,
            "video"=>$json[$text]["file_id"],
            "caption"=>$json[$text]["caption"]
          ]);
        }elseif($json[$text]["type"]=="video_note"){
          bot("sendVideoNote",[
            "chat_id"=>$chat_id,
            "video_note"=>$json[$text]["file_id"]
          ]);
        }elseif($json[$text]["type"]=="photo"){
          bot("sendPhoto",[
            "chat_id"=>$chat_id,
            "photo"=>$json[$text]["file_id"],
            "caption"=>$json[$text]["caption"]
          ]);
        }elseif($json[$text]["type"]=="audio"){
          bot("sendAudio",[
            "chat_id"=>$chat_id,
            "audio"=>$json[$text]["file_id"],
            "caption"=>$json[$text]["caption"]
          ]);
        }elseif($json[$text]["type"]=="voice"){
          bot("sendVoice",[
            "chat_id"=>$chat_id,
            "voice"=>$json[$text]["file_id"],
            "caption"=>$json[$text]["caption"]
          ]);
        }elseif($json[$text]["type"]=="document"){
          bot("sendDocument",[
            "chat_id"=>$chat_id,
            "document"=>$json[$text]["file_id"],
            "caption"=>$json[$text]["caption"]
          ]);
        }
      }else{
       if(isset($up->message->text)){
        bot("forwardMessage",[
          "chat_id"=>$sudo,
          "from_chat_id"=>$chat_id,
          "message_id"=>$msg_id
        ]);
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا._",
          "parse_mode"=>"markdown"
        ]);
        }elseif(isset($up->message->photo)){
          if($setting["photo"]=="no"){
            bot("forwardMessage",[
          "chat_id"=>$sudo,
          "from_chat_id"=>$chat_id,
          "message_id"=>$msg_id
        ]);
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا._",
          "parse_mode"=>"markdown"
        ]);
          }else{
            bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_ئەم جۆرە نامەیە لەلایەن بەڕێوەبەرەوە داخراوە._",
          "parse_mode"=>"markdown"
        ]);
          }
        }elseif(isset($up->message->sticker)){
          if($setting["sticker"]=="no"){
            bot("forwardMessage",[
          "chat_id"=>$sudo,
          "from_chat_id"=>$chat_id,
          "message_id"=>$msg_id
        ]);
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا._",
          "parse_mode"=>"markdown"
        ]);
          }else{
            bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_ئەم جۆرە نامەیە لەلایەن بەڕێوەبەرەوە داخراوە._",
          "parse_mode"=>"markdown"
        ]);
          }
        }elseif(isset($up->message->video)){
          if($setting["video"]=="no"){
            bot("forwardMessage",[
          "chat_id"=>$sudo,
          "from_chat_id"=>$chat_id,
          "message_id"=>$msg_id
        ]);
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا._",
          "parse_mode"=>"markdown"
        ]);
          }else{
            bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_ئەم جۆرە نامەیە لەلایەن بەڕێوەبەرەوە داخراوە._",
          "parse_mode"=>"markdown"
        ]);
          }
        }elseif(isset($up->message->video_note)){
          if($setting["videoNote"]=="no"){
            bot("forwardMessage",[
          "chat_id"=>$sudo,
          "from_chat_id"=>$chat_id,
          "message_id"=>$msg_id
        ]);
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا._",
          "parse_mode"=>"markdown"
        ]);
          }else{
            bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_ئەم جۆرە نامەیە لەلایەن بەڕێوەبەرەوە داخراوە._",
          "parse_mode"=>"markdown"
        ]);
          }
        }elseif(isset($up->message->audio)){
          if($setting["audio"]=="no"){
            bot("forwardMessage",[
          "chat_id"=>$sudo,
          "from_chat_id"=>$chat_id,
          "message_id"=>$msg_id
        ]);
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا._",
          "parse_mode"=>"markdown"
        ]);
          }else{
            bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_ئەم جۆرە نامەیە لەلایەن بەڕێوەبەرەوە داخراوە._",
          "parse_mode"=>"markdown"
        ]);
          }
        }elseif(isset($up->message->voice)){
          if($setting["voice"]=="no"){
            bot("forwardMessage",[
          "chat_id"=>$sudo,
          "from_chat_id"=>$chat_id,
          "message_id"=>$msg_id
        ]);
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا._",
          "parse_mode"=>"markdown"
        ]);
          }else{
            bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_ئەم جۆرە نامەیە لەلایەن بەڕێوەبەرەوە داخراوە._",
          "parse_mode"=>"markdown"
        ]);
          }
        }elseif(isset($up->message->document)){
          if($setting["document"]=="no"){
            bot("forwardMessage",[
          "chat_id"=>$sudo,
          "from_chat_id"=>$chat_id,
          "message_id"=>$msg_id
        ]);
        bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_نامەکەت بە سەرکەوتوویی نێردرا._",
          "parse_mode"=>"markdown"
        ]);
          }else{
            bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_ئەم جۆرە نامەیە لەلایەن بەڕێوەبەرەوە داخراوە._",
          "parse_mode"=>"markdown"
        ]);
          }
        }
      }
    }else{
      bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"_ نامەیەک لە هیچ شوێنێکەوە مەنێرە._",
          "parse_mode"=>"markdown"
        ]);
    }}else{
   bot("sendMessage",[
          "chat_id"=>$chat_id,
          "text"=>"بۆتەکە لەلایەن بەڕێوەبەرەکانەوە کوژاوەتەوە و وەڵامی هیچ پەیامێک نادرێتەوە."
        ]);
 }}
  }
}elseif(isset($up->callback_query)){
$data=$up->callback_query->data;
$cl_msgid=$up->callback_query->message->message_id;
$cl_fromid=$up->callback_query->from->id;
$cl_chatid=$up->callback_query->message->chat->id;
  if($cl_fromid==$sudo){
    if($vaziyat=="empty"){
      if($data=="amar"){
        $count=count($member);
        bot("editMessageText",[
          "chat_id"=>$cl_chatid,
          "text"=>"_ ئاماری ڕۆبۆت بریتیە لە $count بەکارهێنەر._",
          "message_id"=>$cl_msgid,
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["inline_keyboard"=>[[["text"=>"گەڕانەوە 🔙","callback_data"=>"back"]]]])
        ]);
      }elseif($data=="resetbot"){
        file_put_contents("sudo.txt","resetbot");
        bot("sendMessage",[
            "chat_id"=>$cl_chatid,
            "text"=>"ئایا دڵنیایت ؟",
            "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>[[["text"=>"فەشەلکردنەوە"],["text"=>"بەڵێ"]]]])
          ]);
      }elseif($data=="hazfdastur"){
       $json=json_decode(file_get_contents("dasturat.json"),true); 
       if(count($json)!=1){
         unset($json["empty"]);
         foreach($json as $key=>$value){
          if($json[$key]["type"]!="menu"){
           $list="$list\n$key";
         }} file_put_contents("sudo.txt","hazfdastur");
          bot("sendMessage",[
            "chat_id"=>$cl_chatid,
            "text"=>" ناوی ئەو دوگمە بنێرە کەدەتەوێت بیسڕیتەوە 🗑

دوگمەکانت بریتین لە :
            ".$list,
            "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>[[["text"=>"فەشەلکردنەوە"]]]])
          ]);
        }else{
          bot("sendMessage",[
            "chat_id"=>$cl_chatid,
            "text"=>"_هیچ دوگمەیەک بەردەست نیە._",
            "parse_mode"=>"markdown"
          ]);
        }
      }elseif($data=="back"){
        bot("editMessageText",[
          "chat_id"=>$cl_chatid,
          "text"=>"_چی بکەم ، بەڕێوەبەر ؟_",
          "message_id"=>$cl_msgid,
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["inline_keyboard"=>[[["text"=>"ئامار 👥","callback_data"=>"amar"],["text"=>"پڕۆفایل 👤","callback_data"=>"profile"]],[["text"=>"ڕاگەیاندنی هاوردەکراو 🗣","callback_data"=>"forward"],["text"=>"لیستی بلۆک 🚫","callback_data"=>"block"]],[["text"=>"♨️ نامەی دەستپێکی بۆت ♨️","callback_data"=>"start"]],[["text"=>"✏️ڕاگەیاندنی بێ ناونیشان✏️","callback_data"=>"forward2"]],[["text"=>"دوگمە ➕","callback_data"=>"dasturjadid"],["text"=>"دوگمە ➖","callback_data"=>"hazfdastur"]],[["text"=>"بەش ➕","callback_data"=>"createmenu"],["text"=>"بەش ➖","callback_data"=>"deletemenu"]],[["text"=>"⚜ بەڕێوبەری بەش ⚜","callback_data"=>"managementmenu"]],[["text"=>"سڕینەوەی گشتی","callback_data"=>"resetbot"]],[["text"=>"✉️ ڕێکخستنەکانی داخستنی نامە ✉️","callback_data"=>"settingmsg"]]]])
        ]);
      }elseif($data=="settingmsg"){
        $list=array();
        $num=0;
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
        bot("sendMessage",[
          "chat_id"=>$cl_chatid,
          "text"=>"_>>>ڕێکخستنەکانی داخستنی نامە<<<_",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
      }elseif($data=="sticker:yes"){
        $setting["sticker"]="no";
        $option=json_encode($setting);
        file_put_contents("setting.json","$option");
        $num=0;
        $list=array();
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
        bot("editMessageReplyMarkup",[
        "chat_id"=>$cl_chatid,
        "message_id"=>$cl_msgid,
        "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
        bot("answerCallbackQuery",[
          "callback_query_id"=>$up->callback_query->id,
          "text"=>"ئەنجام درا."
        ]);
      }elseif($data=="sticker:no"){
        $setting["sticker"]="yes";
        $option=json_encode($setting);
        file_put_contents("setting.json","$option");
        $num=0;
        $list=array();
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
        bot("editMessageReplyMarkup",[
        "chat_id"=>$cl_chatid,
        "message_id"=>$cl_msgid,
        "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
        bot("answerCallbackQuery",[
          "callback_query_id"=>$up->callback_query->id,
          "text"=>"ئەنجام درا."
        ]);
      }elseif($data=="photo:yes"){
        $setting["photo"]="no";
        $option=json_encode($setting);
        file_put_contents("setting.json","$option");
        $num=0;
        $list=array();
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
        bot("editMessageReplyMarkup",[
        "chat_id"=>$cl_chatid,
        "message_id"=>$cl_msgid,
        "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
        bot("answerCallbackQuery",[
          "callback_query_id"=>$up->callback_query->id,
          "text"=>"ئەنجام درا."
        ]);
      }elseif($data=="photo:no"){
        $setting["photo"]="yes";
        $option=json_encode($setting);
        file_put_contents("setting.json","$option");
        $num=0;
        $list=array();
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
        bot("editMessageReplyMarkup",[
        "chat_id"=>$cl_chatid,
        "message_id"=>$cl_msgid,
        "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
        bot("answerCallbackQuery",[
          "callback_query_id"=>$up->callback_query->id,
          "text"=>"ئەنجام درا."
        ]);
      }elseif($data=="video:yes"){
        $setting["video"]="no";
        $option=json_encode($setting);
        file_put_contents("setting.json","$option");
        $num=0;
        $list=array();
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
        bot("editMessageReplyMarkup",[
        "chat_id"=>$cl_chatid,
        "message_id"=>$cl_msgid,
        "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
        bot("answerCallbackQuery",[
          "callback_query_id"=>$up->callback_query->id,
          "text"=>"ئەنجام درا."
        ]);
      }elseif($data=="video:no"){
        $setting["video"]="yes";
        $option=json_encode($setting);
        file_put_contents("setting.json","$option");
        $num=0;
        $list=array();
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
        bot("editMessageReplyMarkup",[
        "chat_id"=>$cl_chatid,
        "message_id"=>$cl_msgid,
        "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
        bot("answerCallbackQuery",[
          "callback_query_id"=>$up->callback_query->id,
          "text"=>"ئەنجام درا."
        ]);
      }elseif($data=="videoNote:yes"){
        $setting["videoNote"]="no";
        $option=json_encode($setting);
        file_put_contents("setting.json","$option");
        $num=0;
        $list=array();
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
        bot("editMessageReplyMarkup",[
        "chat_id"=>$cl_chatid,
        "message_id"=>$cl_msgid,
        "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
       bot("answerCallbackQuery",[
          "callback_query_id"=>$up->callback_query->id,
          "text"=>"ئەنجام درا."
        ]);
      }elseif($data=="videoNote:no"){
        $setting["videoNote"]="yes";
        $option=json_encode($setting);
        file_put_contents("setting.json","$option");
        $num=0;
        $list=array();
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
       bot("editMessageReplyMarkup",[
        "chat_id"=>$cl_chatid,
        "message_id"=>$cl_msgid,
        "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
        bot("answerCallbackQuery",[
          "callback_query_id"=>$up->callback_query->id,
          "text"=>"ئەنجام درا."
        ]);
      }elseif($data=="audio:yes"){
        $setting["audio"]="no";
        $option=json_encode($setting);
        file_put_contents("setting.json","$option");
        $num=0;
        $list=array();
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
        bot("editMessageReplyMarkup",[
        "chat_id"=>$cl_chatid,
        "message_id"=>$cl_msgid,
        "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
        bot("answerCallbackQuery",[
          "callback_query_id"=>$up->callback_query->id,
          "text"=>"ئەنجام درا."
        ]);
      }elseif($data=="audio:no"){
        $setting["audio"]="yes";
        $option=json_encode($setting);
        file_put_contents("setting.json","$option");
        $num=0;
        $list=array();
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
        bot("editMessageReplyMarkup",[
        "chat_id"=>$cl_chatid,
        "message_id"=>$cl_msgid,
        "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
        bot("answerCallbackQuery",[
          "callback_query_id"=>$up->callback_query->id,
          "text"=>"ئەنجام درا."
        ]);
      }elseif($data=="voice:yes"){
        $setting["voice"]="no";
        $option=json_encode($setting);
        file_put_contents("setting.json","$option");
        $num=0;
        $list=array();
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
        bot("editMessageReplyMarkup",[
        "chat_id"=>$cl_chatid,
        "message_id"=>$cl_msgid,
        "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
        bot("answerCallbackQuery",[
          "callback_query_id"=>$up->callback_query->id,
          "text"=>"ئەنجام درا."
        ]);
      }elseif($data=="voice:no"){
        $setting["voice"]="yes";
        $option=json_encode($setting);
        file_put_contents("setting.json","$option");
        $num=0;
        $list=array();
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
        bot("editMessageReplyMarkup",[
        "chat_id"=>$cl_chatid,
        "message_id"=>$cl_msgid,
        "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
        bot("answerCallbackQuery",[
          "callback_query_id"=>$up->callback_query->id,
          "text"=>"ئەنجام درا."
        ]);
      }elseif($data=="document:yes"){
        $setting["document"]="no";
        $option=json_encode($setting);
        file_put_contents("setting.json","$option");
        $num=0;
        $list=array();
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
        bot("editMessageReplyMarkup",[
        "chat_id"=>$cl_chatid,
        "message_id"=>$cl_msgid,
        "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
        bot("answerCallbackQuery",[
          "callback_query_id"=>$up->callback_query->id,
          "text"=>"ئەنجام درا."
        ]);
      }elseif($data=="document:no"){
        $setting["document"]="yes";
        $option=json_encode($setting);
        file_put_contents("setting.json","$option");
        $num=0;
        $list=array();
        foreach($setting as $key=>$value){
          $list[$num]=array(array("text"=>"$key","callback_data"=>"$key"),array("text"=>"$value","callback_data"=>"$key:$value"));
          $num++;
        }
        bot("editMessageReplyMarkup",[
        "chat_id"=>$cl_chatid,
        "message_id"=>$cl_msgid,
        "reply_markup"=>json_encode(["inline_keyboard"=>$list])
        ]);
        bot("answerCallbackQuery",[
          "callback_query_id"=>$up->callback_query->id,
          "text"=>"ئەنجام درا."
        ]);
      }elseif($data=="profile"){
        bot("editMessageText",[
          "chat_id"=>$cl_chatid,
          "text"=>file_get_contents("profile.txt"),
          "message_id"=>$cl_msgid,
          "reply_markup"=>json_encode(["inline_keyboard"=>[[["text"=>"گەڕانەوە 🔙","callback_data"=>"back"],["text"=>"گۆڕانکاری 🖊","callback_data"=>"changeprofile"]]]])
        ]);
      }elseif($data=="dasturjadid"){
        file_put_contents("sudo.txt","dasturjadid");
        bot("sendMessage",[
          "chat_id"=>$cl_chatid,
          "text"=>"_ناوی ئەو دوگمە بنێرە کەدەتەوێت زیادی بکەیت_",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>[[["text"=>"فەشەلکردنەوە"]]]])
        ]);
      }elseif($data=="changeprofile"){
        file_put_contents("sudo.txt","profile");
        bot("sendMessage",[
          "chat_id"=>$cl_chatid,
          "text"=>"_تەنها پەیامەکەت بنێرە کە دەقی تێدایە._",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>[[["text"=>"فەشەلکردنەوە"]]]])
        ]);
      }elseif($data=="forward2"){
        file_put_contents("sudo.txt","forward2");
        bot("sendMessage",[
          "chat_id"=>$cl_chatid,
          "text"=>"_ئەوەبنێرە کەدەتەوێت ڕایبگەیەنیت بە بەکارهێنەرانی بۆت_",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>[[["text"=>"فەشەلکردنەوە"]]]])]);
      }elseif($data=="createmenu"){
        file_put_contents("sudo.txt","createmenu");
        bot("sendMessage",[
          "chat_id"=>$cl_chatid,
          "text"=>"ناوی بەش بنێرە ",
          "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>[[["text"=>"فەشەلکردنەوە"]]]])]);
      }elseif($data=="managementmenu"){
        $list=array();
        $json=json_decode(file_get_contents("dasturat.json"),true);
        foreach($json as $key=>$value){
          if($json[$key]["type"]=="menu"){
            $list[$key]=array(array("text"=>"$key"));
          }
        }
        $list=array_values($list);
        if(count($list!=0)){
          bot("sendMessage",[
            "chat_id"=>$cl_chatid,
            "text"=>"بەش و لیستە لاوەکیەکان بەردەستن.↓↓",
            "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>$list])
          ]);       
        }else{
          bot("sendMessage",[
            "chat_id"=>$cl_chatid,
            "text"=>"بەش یان لیستی لاوەکی بەردەست نیە."]);
        }
      }elseif($data=="deletemenu"){
        $json=json_decode(file_get_contents("dasturat.json"),true);
        $list=array();
        foreach($json as $key=>$value){
          if($json[$key]["type"]=="menu"){
            $list[$key]=array(array("text"=>"$key"));
          }
        }
        $list=array_values($list);
        if(count($list)!=0){
          file_put_contents("sudo.txt","deletemenu");
          $list[count($list)]=array(array("text"=>"فەشەلکردنەوە"));
          bot("sendMessage",[
            "chat_id"=>$cl_chatid,
            "text"=>"بەشە بەردەستەکان و لیستە لاوەکیەکان.",
            "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>$list])
          ]);
        }else{
          bot("sendMessage",[
            "chat_id"=>$cl_chatid,
            "text"=>"هیچ بەش و لیستی لاوەکی بەردەست نیە."]);
        }
      }elseif($data=="forward"){
        file_put_contents("sudo.txt","forward");
        bot("sendMessage",[
          "chat_id"=>$cl_chatid,
          "text"=>"_ئەوەبنێرە کەدەتەوێت ڕایبگەیەنیت بە بەکارهێنەرانی بۆت_",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>[[["text"=>"فەشەلکردنەوە"]]]])]);
      }elseif($data=="start"){
        $txt=file_get_contents("start.txt");
        bot("editMessageText",[
          "chat_id"=>$cl_chatid,
          "text"=>"$txt",
          "message_id"=>$cl_msgid,
          "reply_markup"=>json_encode(["inline_keyboard"=>[[["text"=>"گەڕانەوە 🔙","callback_data"=>"back"],["text"=>"گۆڕانکاری 🖊","callback_data"=>"changestart"]]]])
        ]);
      }elseif($data=="changestart"){
        file_put_contents("sudo.txt","start");
        bot("sendMessage",[
          "chat_id"=>$cl_chatid,
          "text"=>"
          ئەو نوسینە بنێرە کەدەتەوێت نیشان بدرێت بۆ دەست پێک 

دەتوانیت ئەمانەش بەکاربێنیت↓ 

userid ایدی
firstname ناوی یەکەم
lastname ناوی دووەم 
username یوزەر نەیم

          ",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode(["resize_keyboard"=>true,"keyboard"=>[[["text"=>"فەشەلکردنەوە"]]]])
        ]);
      }elseif($data=="block"){
        $array=explode("\n",str_replace("block\n","",file_get_contents("block.txt")));
        if($array[0]!="block"){
          $list=array();
          foreach($array as $key=>$value){
            $list[$key]=array(array("text"=>"$value","callback_data"=>"$value"));
          }
          bot("sendMessage",[
            "chat_id"=>$cl_chatid,
            "text"=>"_>>>لیستی بلۆک<<<_",
            "parse_mode"=>"markdown",
            "reply_markup"=>json_encode(array("inline_keyboard"=>$list))
          ]);
        }else{
          bot("sendMessage",[
          "chat_id"=>$cl_chatid,
          "text"=>"_لیستی بلۆک بەتاڵە._",
          "parse_mode"=>"markdown"
          ]);
        }
      }else{
        file_put_contents("block.txt",str_replace("\n$data","",file_get_contents("block.txt")));
        bot("sendMessage",[
          "chat_id"=>$data+0,
          "text"=>"_تۆ لە دەرەوەی بلۆک یت._",
          "parse_mode"=>"markdown"
        ]);
        $array=explode("\n",str_replace("block\n","",file_get_contents("block.txt")));
        if($array[0]!="block"){
          $list=array();
          foreach($array as $key=>$value){
            $list[$key]=array(array("text"=>"$value","callback_data"=>"$value"));
          }
          bot("editMessageReplyMarkup",[
            "chat_id"=>$cl_chatid,
            "message_id"=>$cl_msgid, "reply_markup"=>json_encode(array("inline_keyboard"=>$list))
          ]);
        }else{
          bot("editMessageText",[
            "chat_id"=>$cl_chatid,
            "message_id"=>$cl_msgid,
            "text"=>"_لیستی بلۆک بەتاڵە._",
            "parse_mode"=>"markdown"
          ]);
        }
      }
    }else{
      bot("answerCallbackQuery",[
        "callback_query_id"=>$up->callback_query->id,
        "text"=>" تۆ کردارێکی تر ئەکەیت
        یەکەم جار بەتاڵی بکەرەوە..",
        "show_alert"=>true
      ]);
    }
  }else{
    bot("answerCallbackQuery",[
        "callback_query_id"=>$up->callback_query->id,
        "text"=>"تۆ بەڕێوەبەرێکی ڕۆبۆت نیت..",
        "show_alert"=>true
      ]);
  }
}
?>