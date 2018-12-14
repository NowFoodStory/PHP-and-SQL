<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="utf8">
    <title>關鍵字查詢範例</title>
    <style>
        kaiText
        {
            font-family : 微軟正黑體;
            font-size : 18px;
            text-align : left
            line-height: 30px;
        }
    </style>
</head>
<body>
    <kaiText>
        <form action="queryProcess.php" method="GET">
            <table border="0">

                <tr>
                    <td>查詢欄位</td>
                    <td>
                        <select name="queryField">
                            <option value="stuSno">學號</option>
                            <option value="stuName">姓名</option>
                            <option value="stuPhone">電話</option>
                            <option value="stuAddress">住址</option>
                        </select>
                    </td>
                </tr>
                <tr><td>搜尋內容</td><td><input type="text" name="queryString" size="20"></td></tr>
                <tr><td></td><td align="right"><input type="submit" name="submit" value="搜尋"></td></tr>
            </table>
        </form>
    </kaiText>
    <a href="index.html">創思首頁</a>
</body>
</html>

3.查詢表單可依各欄位來進行查詢，確定查詢後，再將後續流程提交 queryProcess.php ，至於queryProcess.php 內容如下：
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
    <style>
        kaiText
        {
            font-family : 微軟正黑體;
            font-size : 20px;
            line-height : 36px;
        }
    </style>
</head>
<body>

<?php
    include "dbConfig.php";
    //--------------------------------------------
    // 以下開始擷取來自表單資料進行資料庫搜尋動作
    //--------------------------------------------
    $queryField = $_GET["queryField"];
    $keyWord = $_GET["queryString"];
    $searchField = "";
    //--------------------------------------------
    // 學號 => sno
    // 姓名 => name
    // 住址 => phone
    // 電話 => address
    // 以下根據來自表單之下拉式清單選項內容來決定
    // 對資料庫哪個欄位來進行搜尋動作
    //-------------------------------------------
    if (!strcmp($queryField, "stuSno"))
    {
        $searchField = "sno";
    }
    else if (!strcmp($queryField, "stuName"))
    {
        $searchField = "name";
    }
    else if (!strcmp($queryField, "stuPhone"))
    {
        $searchField = "phone";
    }
    else if (!strcmp($queryField, "stuAddress"))
    {
        $searchField = "address";
    }
    else
    {
        // nothing to do 
    }
    //-------------------------------------------------------------------------
    // 以下查詢字串的格式，請利用 like 搭配 % 敘述來做萬用字元比對
    // 
    //-------------------------------------------------------------------------
    $queryString = "select * from student where $searchField like '%$keyWord%'";
    //-------------------------------------------------------------------------
    try
    {
        $recordSet = $dbLink->query($queryString);
        $recordRow = $recordSet->fetchAll();
        //
        if (count($recordRow) != 0)
        {
            print "<kaiText>";
            print "搜尋結果如下";
            // print $queryString;
            print "<table border=1>";
            print "<tr><td>學號</td><td>姓名</td><td>電話</td><td>住址</td></tr>";
            for ($i=0; $i<count($recordRow); $i++)
            {
                print "<tr>";
                print "<td>".$recordRow[$i]["sno"]."</td>";
                print "<td>".$recordRow[$i]["name"]."</td>";
                print "<td>".$recordRow[$i]["phone"]."</td>";
                print "<td>".$recordRow[$i]["address"]."</td>";
                print "</tr>";
            }
            print "</table>";
            print "</kaiText>";
        }
        else
        {
            print "<kaiText>搜尋不到任何符合條件的紀錄<kaiText>";
        }

    }
    catch (PDOException $pdoe)
    {
        print "查詢錯誤：".$pdoe->getMessage();
    }
    //------------------------------------------------
    print "<br><a href='index.html'>創思首頁</a>";
?> 
</body>
</html>