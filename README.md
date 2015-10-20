# 七联课程申请 

### 图片上传路径权限修改
sudo chown apache:apache /app/webroot/img

### 数据库配置修改/app/Config/database.php
```php
public $default = array(
                'datasource' => 'Database/Mysql',
                'persistent' => false,
                'host' => 'xxx.xxx.xxx.xxx',
                'login' => 'user',
                'password' => 'pass',
                'database' => 'db',
                'prefix' => 'form_',
                'encoding' => 'utf8',
        );
```

### 数据库文件
参照db.sql，昨晚讨论的内容还未更新修改到该文件中，龙哥将数据库再做修改吧！
