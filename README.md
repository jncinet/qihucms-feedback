<h1 align="center">站内留言反馈</h1>

## 安装
```shell
composer require jncinet/qihucms-feedback
```


## 开始
### 数据迁移
```shell
$ php artisan migrate
```

### 发布资源
```shell
$ php artisan vendor:publish --provider="Qihucms\Feedback\FeedbackServiceProvider"
```

## 后台菜单
+ 反馈记录 `feedback`

## 使用

### 路由参数说明

#### 反馈列表
+ 请求方式 GET
+ 请求地址 `feedback?limit=15每页显示条数&page=1页码`
+ 返回值
```
{
    "data": [
        {
            'id' => 1,
            'user_id' => "反馈会员ID",
            'title' => "反馈标题",
            'content' => "反馈内容",
            'file' => "图片地址",
            'contact' => "联系方式",
            'reply' => "回复内容",
            'status' => 1, // 状态
            'created_at' => "1分钟前",
            'updated_at' => "1小时前",
        },
        ...
    ],
    "meta": {},
    "links": {},
}
```

#### 反馈发布
+ 请求方式 POST
+ 请求地址 `feedback`
+ 请求参数
```
{
    'title': "反馈标题",
    'content': "反馈内容",
    'file': "图片附件",
    'contact': "反馈内容"
}
```
+ 返回值
```
{
    'id' => 1,
    'user_id' => "反馈会员ID",
    'title' => "反馈标题",
    'content' => "反馈内容",
    'file' => "图片地址",
    'contact' => "联系方式",
    'reply' => "回复内容",
    'status' => 1, // 状态
    'created_at' => "1分钟前",
    'updated_at' => "1小时前",
}
```

#### 反馈详细
+ 请求方式 GET
+ 请求地址 `feedback/{id=反馈ID}`
+ 返回值
```
{
    'id' => 1,
    'user_id' => "反馈会员ID",
    'title' => "反馈标题",
    'content' => "反馈内容",
    'file' => "图片地址",
    'contact' => "联系方式",
    'reply' => "回复内容",
    'status' => 1, // 状态
    'created_at' => "1分钟前",
    'updated_at' => "1小时前",
}
```

#### 反馈更新
+ 请求方式 PATCH|PUT
+ 请求地址 `feedback/{id=反馈ID}`
+ 请求参数：
```
{
    'title': "反馈标题",
    'content': "反馈内容",
    'file': "图片附件",
    'contact': "反馈内容"
}
```
+ 返回值
```
{
    "result": {
        id: 1 // 反馈ID
    }
}
```

#### 反馈删除
+ 请求方式 DELETE
+ 请求地址 `feedback/{id=反馈ID}`
+ 返回值
```
{
    "result": {
        id: 1 // 反馈ID
    }
}
```

## 数据库

### 反馈记录表：feedback

| Field             | Type      | Length    | AllowNull | Default   | Comment       |
| :----             | :----     | :----     | :----     | :----     | :----         |
| id                | bigint    |           |           |           |               |
| user_id           | bigint    |           |           | 0         | 会员ID         |
| title             | varchar   | 255       |           |           | 问题标题       |
| content           | text      |           |           |           | 问题描述       |
| reply             | text      |           | Y         | NULL      | 问题回复       |
| contact           | varchar   | 255       | Y         | NULL      | 联系方式       |
| file              | varchar   | 255       | Y         | NULL      | 附件           |
| status            | int       |           |           | 0         | 状态           |
| created_at        | timestamp |           | Y         | NULL      | 创建时间        |
| updated_at        | timestamp |           | Y         | NULL      | 更新时间        |
