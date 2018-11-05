<!DOCTYPE html>
<html lang="en">
<?php
    require_once("BoardDao.php");
    $bdao = new BoardDao();
    $board = $bdao->getMsgs();

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Table Pagination</title>

    <link href="bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
    
    <div class="container" style="margin-top:35px">
        <h4>Select Number of Rows</h4>
        <div class="form-group">
            <select name="state" id="maxRows" class="form-control" style="width:150px;">
                <option value="5000">Show All</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="75">75</option>
                <option value="100">100</option>
            </select>
        </div>
        <table id="mytable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Writer</th>
                    <th>Title</th>
                    <th>Regtime</th>
                    <th>Hits</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($board as $rows) : ?>
                    <tr>
                        <td><?= $rows['Writer'] ?></td>
                        <td><?= $rows['Title'] ?></td>
                        <td><?= $rows['Regtime'] ?></td>
                        <td><?= $rows['Hits'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="pagination-container">
            <nav>
                <ul class="pagination"></ul>
            </nav>
        </div>
    </div>

    <script src="jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script>
    var table = '#mytable'
    $('#maxRows').on('change', function(){
        $('.pagination').html('')
        var trnum = 0
        var maxRows = parseInt($(this).val())
        var totalRows = $(table+' tbody tr').length
        $(table+' tr:gt(0)').each(function(){
            trnum++
            if(trnum > maxRows){
                $(this).hide()
            }
            if(trnum <= maxRows){
                $(this).show()
            }
        })
        if(totalRows > maxRows){
            var pagenum = Math.ceil(totalRows/maxRows)
            for(var i=1;i<=pagenum;){
                $('.pagination').append('<li data-page="'+i+'">\<span>'+ i++ +'<span class="sr-only">(current)</span></span>\</li>').show()
            }
        }
        $('.pagination li:first-child').addClass('active')
        $('.pagination li').on('click',function(){
            var pageNum = $(this).attr('data-page')
            var trIndex = 0;
            $('.pagination li').removeClass('active')
            $(this).addClass('active')
            $(table+' tr:gt(0)').each(function(){
                trIndex++
                if(trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
                    $(this).hide()
                } else{
                    $(this).show()
                }
            })
        })
    })
    $(function(){
        $('table tr:eq(0)').prepend('<th>ID</th>')
        var id = 0;
        $('table tr:gt(0)').each(function(){
            id++
            $(this).prepend('<td>'+id+'</td>')
        })
    })
    </script>
</body>
</html>