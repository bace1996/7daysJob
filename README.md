# 7daysJob
Yet another just-for-learning web application written in php.

## 食用指南
 - 主要基于PHP7 / Symfony 4 / Doctrine-MongoDB-ODM / Jquery / Bootstrap
 - 整套东西都在虚拟机Fedora上用Phpstorm写的
 - 在开始之前需要访问下 `/init` 初始化一个示例数据，这个url只是方便部署环境插入测试数据，产品中不应当存在。

## 已知缺陷
 - 申请页面弹出的下滑同台效果未实现
 - 申请页面的状态row箭头效果未实现
 - 重新访问此页面会丢失答题结果
 - 个人信息删减了一大半，包括简历上传，这是个难点，初步感觉可以binary直接丢db里面
 
## 收获
 - 入门PHP / Symfony / Jquery / MongoDB
 - 重点看了看CSS Selector的使用，还是蛮好玩的
 - 看着这边获取数据库Manager实例的操作回想起之前Odoo的开发，终于理解了什么是控制反转和依赖注入

## TODO
 - 应该还有个增删该查申请的界面，后面两天学校有安排，没法按时交卷了
    不过应该也快的，JQ异步加载已经摸到了，后台DB的CR已经实操了，主要的Many2one和One2many ODM使用也回了，UD也就没啥了
    目测主要难点在登陆的token处理还有一些前端的交互逻辑，不过debug的时候看到symfony好像有自带的一套token管理

## 小结
    前面从环境到走通数据库弄了很久，大约两天。
    第三天主要在研究怎么把问题和个人信息两个form同时提交，一开始不知道用jquery，就直接暴力合并了。
    第四天才回过头来设计数据库对象，一套流程走通了后面就很快了
    很多地方还是使用了很暴力很不优雅的做法，包括申请状态切换，强行的去隐藏和设置颜色，还有form，强行模板render写入岗位主键
    css的部分先是copy了原版的html，然后样式和效果大部分都是google实现的，少量f12看了属性，颜色值都是copy的
    时间比较赶，一边还要改论文准备中期检查，很多东西就摸了个大概，后面要精细的处理我得去摸点别人的项目看下`最佳实践`之类的