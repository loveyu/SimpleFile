﻿# php文件管理
## 作者信息

* 作者 : 恋羽
* 博客 : [http://www.loveyu.org](http://www.loveyu.org)
* 反馈地址 : [http://www.loveyu.org/1415.html](http://www.loveyu.org/1415.html)
* 最新版本 : 2.06
* 更新说明 : 程序将不再更新，请使用新的管理器 [http://www.loveyu.org/2429.html](http://www.loveyu.org/2429.html)，支持更多的操作也更优雅

## 版本更新说明
* 2.06增加目录详细跳转功能
* 2.05增加一邮件发送功能
* 2.04修正执行代码时的一小错误，修正网站显示//地址的问题
* 2.03增加文件目录中文件夹和文件个数的显示，取消对整个目录下文件大小的计算，那是一个错误
* 2.02修正小错误
* 2.01修正上传文件中出现的一个错误，修正文件所有者得显示，win下不显示
* 2.00模拟DA控制面板文件管理器
* 1.05修正新建文件夹权限不对的问题
* 1.04修正1.03中弄反函数的问题，导致修改的权限依然不对
* 1.03增加对目录权限的递归修改，可分别设置文件与目录权限
* 1.02修正修改权限时没有改为8进制导致修改权限乱的问题
* 1.01修正view.php中'/'错位导致底部导航查看文件不准确

## 功能说明
* 查看文件：可以下载文件和阅读文件，如果是图片可以查看
* 新文件夹：创建新文件夹，不用介绍
* 创建文件：支持指定常用编码
* 修改文件：可以切换常用编码
* 重命名：可以同时对一目录下的多文件（夹）进行改名
* 权限修改：可以同时对一目录下的多文件（夹）进行权限修改，对于有时候php没有的权限那是没办法的，只有用ftp
* 上传文件：一次上传多文件，同时可指定其文件名，不指定就为原始文件名
* 复制文件：包括复制其子目录及文件
* 删除文件：一次全删干净，包括子目录
* 远程下载：直接下载文件到服务器，最好是指定文件，不然问题多多的，我采用了一个很烂的规则，当然，如果是 http://www.loveyu.org/wp-admin/post-new.php 就会命名为post-new.php.dl ，php5和asp也一样，如果是 http://www.loveyu.org/wp-admin/post-new.zip?sadas=dsahd 则会命名为post-new.zip,如果是 http://www.loveyu.org 就会自动命名为.dl，所以，如果确定文件地址很正规则不需要命名。
* unzip操作：选择zip文档，解压到指定目录
* zip操作：支持压缩文件及其子目录
* 执行php代码：可以玩玩的，有时候直接执行php代码，还不错
* 移动文件：如果你空间允许使用系统函数就用它移动，否则建议先复制再删除，毕竟php无移动文件函数。