# adress
    short address project
    http://t.cn/IsqlQsv ==> 对应一个网址

后台使用mongodb存储数据
    > show dbs;show dbs;
    address  0.031GB
    local    0.031GB
    > use adderssuse adderss
    switched to db adderss
    > show collectionsshow collections
    > use addressuse address
    switched to db address
    > db.shshow collectionsshow collections
    primaryid
    record
    system.indexes
    > db.recdb.record.find()db.record.find()
    { "_id" : 12, "code" : "D", "src" : "http://www.baidu.com", "srcmd5" : "bfa89e563d9509fbc5c6503dd50faf2e" }
    > db.primadb.primaryid.find()db.primaryid.find()
    { "_id" : 1, "id" : 13 }

nginx rewrite rules
    location ~* /address/(\w+)$ {
             #try_file $uri $uri/ @jump;
             if (!-f $request_filename) {
                     rewrite "/address/(.*)" /address/jump.php?q=$1 last;
             }
             break;
             #alias /address/jump.php?q=$1;
             #if(!-f "$request_filename") {
                     #rewrite "/address\/(.*)/" /address/jump.php?r=$1;
             #}
     }
     location ~* /address/\w+\.php$ {
             fastcgi_split_path_info ^(.+\.php)(/.+)$;
             # NOTE: You should have "cgi.fix_pathinfo = 0;" in php.ini
             # With php5-cgi alone:
             #fastcgi_pass 127.0.0.1:9000;
             # With php5-fpm:
             fastcgi_pass unix:/var/run/php5-fpm.sock;
             fastcgi_index index.php;
             include fastcgi_params;
     }
