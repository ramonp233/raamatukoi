<?php

include ("header.php");
include ("components/database.php");

if(!$_SESSION['username']){

	header("Location: /raamatukoi/");
	exit();
}
?>


<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- <a class="navbar-brand" href="#">Project name</a> -->
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a>Raamatukoi infosüsteem</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo $_SESSION['username']; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <a href="#">Minu andmed</a></li>
                        <li><a href="components/logout.php">Logi välja</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
<div class="container box">
    <div class="left-content">
        <ul>
            <li class="active">
                <a href="home.php"><i class="fa fa-list"></i> Raamatud</a>
            </li>
            <?php
            if($_SESSION["admin"] == 0){
                ?>
                <li>
                    <a href="user-books.php"><i class="fa fa-list"></i> Minu raamatud</a>
                </li>
            <?php
            }
            ?>
            <?php
            if($_SESSION["admin"] == 1){
                ?>
                <li>
                    <a href="users.php"><i class="fa fa-list"></i> Kasutajad</a>
                </li>
                <li>
                    <a href="books-out.php"><i class="fa fa-list"></i> Välja antud raamatud</a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
    <div class="right-content">
        <div class="right-content-header">
            <div class="pull-left">Raamatud</div>
        </div>
        <div class="clear"></div>

        <?php



       // foreach($book as $single_book){
         //   echo utf8_encode ( $book[1] );
        //}




        $books = "SELECT * FROM books";
        $books_result = mysqli_query($connection, $books);




        ?>




        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Raamatu nimi</th>
                <th>Autor</th>
                <th>Kogus</th>
                <th style="text-align: center;">Laenuta välja</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $books_result->fetch_assoc()) {
                ?>
                <tr>
                    <td>
                        <?php
                        echo $row['id'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo  utf8_encode($row['name']);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo utf8_encode($row['author']);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo  $row['quantity'];
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <button><i class="fa fa-book"></i></button>
                    </td>

                </tr>
            <?php
            }
            $row = "";
            ?>
            </tbody>
        </table>

        <div class="right-content-footer">
            <div class="paginator-lk pull-left">lk 1 / 1</div>
            <ul class="paginator">
                <li><a href="#" id="next-page"><i class="fa fa-caret-right"></i></a></li>
                <li><a href="#" id="last-page"><i class="fa fa-caret-right"></i><i class="fa fa-caret-right"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<div id="footer">
    <div class="container">
        © 2015 Raamatukoi infosüsteem
    </div>
</div>
<div class="modal fade" id="messages" tabindex="-1" role="dialog" aria-labelledby="sheet-modal-lbl" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title clearfix" id="sheet-modal-lbl">
                    <div class="title-left">Uus sõnum</div>
                    <div class="title-right"></div>
                </h4>
            </div> <!-- /.modal-header -->
            <form method="post" id="message-form" class="clearfix" data-action="mail/send">
                <div class="modal-body clearfix">
                    <div>
                        <select name='recipient_id' class='field-select' id='' data-url='' data-target=''><option value="0">Kõik kasutajad</option><option value="572">1024945725</option><option value="570">1158052369</option><option value="569">11857828</option><option value="568">1228109609</option><option value="564">1618493918</option><option value="566">1699657704</option><option value="574">1896930906</option><option value="573">1961869718</option><option value="565">250871735</option><option value="571">673155350</option><option value="567">877570385</option><option value="60">Jaan Olde</option><option value="2">Janno Metsa</option><option value="61">Janus Metsa</option><option value="62">Mikk Kurrikoff</option><option value="63">Peeter Ignaatjev</option><option value="64">Raivo Lipping</option></select>								<div class="empty-row"></div>
                        <textarea name="body" class="field" placeholder="Sinu sõnum..."></textarea>
                    </div>
                </div> <!-- /.modal-body -->
                <div class="modal-footer">
                    <button class='btn btn-green btn-sm pull-left' type='submit'>Saada</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Sulge</button>
                </div><!-- /.modal-footer -->
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
</html>

