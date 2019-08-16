# 直播接口

### 1、接口地址及请求方式
```
GET    http://api.medlive.cn/school/class_list.php
```

### 2、参数说明

| 参数 | 名称 | 说明 |
| - | - | - |
| project_id | 项目id | 肾科达标行项目ID为78 |
| type | 列表类型 | 1、待直播，2、正在直播，3、直播回放，不传不分类型 |
| start_time | 搜索开始时间 | 格式：yyyy-MM-dd HH:mm:ss 或者 yyyy-MM-dd|
| end_time | 搜索结束时间 | 格式：yyyy-MM-dd HH:mm:ss 或者 yyyy-MM-dd|
| page | 第几页 | 默认第一页 |
| page_size | 每页显示条数 | 默认显示20条 | 



### 3、返回数据

```
{
    "result_code": "00000",
    "data": {
        "total": "列表总条数"
    },
    "data_list": [
        {
            "id": "直播ID",                 
            "project_id": "项目id",
            "user_name": "医生姓名",
            "hospital": "医院",
            "department": "科室",
            "post": "职位",
            "live_title": "标题",
            "start_time": "开始时间",
            "end_time": "结束时间"
        },
        {
            "id": 666,
            "project_id": 78,
            "user_name": "杜冰楠",
            "hospital": "北京安达心脑病医院",
            "department": "肝病科",
            "post": "药师",
            "live_title": "直播测试标题66",
            "start_time": "2019-06-06 14:00",
            "end_time": "2019-06-06 15:00"
        }
    ],
    "err_msg": "",
    "success_msg": ""
}
```