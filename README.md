#### 开始开发：

请先配置数据库：

执行命令：

1. composer install --ignore-platform-reqs
2. composer dump-auto
3. php artisan storage:link

#### 公共方法

1. 如果需要获取用户（骑手、商家、管理员）表的信息：

​         使用 auth()->user()->需要的字段，获取的时候需要在auth中添加参数

​         骑手：rider  商家：business 普通管理员：admin 超级管理员：api

​         例子：如果想要获取商家的姓名

 auth('business ')->user()->name 即可获取商家的姓名

2. 上传图片的公共方法：

   直接使用 upload（$pic）传入的参数就是图片，返回的是一个相对路径

3. 邮箱发送验证的公共方法：

   ```php
   email($ce, $email,$yong)
   //传入的三个参数是，发送的内容，发送给那个邮箱，发送的主题。
   ```

**需要注意**:

在测试的时候，需要先登录相应的用户，然后复制用户的token，在测试的时候传入。但是无需向前端索取token
