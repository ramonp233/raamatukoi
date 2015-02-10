<?php

include ("header.php");

if($_SESSION['username']){
} else {
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
                <a href="/invoice"><i class="fa fa-list"></i> Raamatud</a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-folder"></i> Minu <b class="fa fa-caret-down pull-right"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="/building">subMenu-element-2</a></li>
                    <li><a href="/account">subMenu-element-2</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-arrow-down"></i> Menu-element-3 <b class="fa fa-caret-down pull-right"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="/import/invoice">subMenu-element-3</a></li>
                    <li><a href="/import/object">subMenu-element-3</a></li>
                </ul>
            </li>
            <li>
                <a href="/report/edited_invoices"><i class="fa fa-arrow-up"></i> Menu-element-4</a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bar-chart-o"></i> Menu-element-5 <b class="fa fa-caret-down pull-right"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="/report/report_list">subMenu-element-5</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="right-content">
        <div class="right-content-header">
            <div class="pull-left">Issues</div>
        </div>
        <div class="clear"></div>
        
        <table class="table">
            <thead>
            <tr>
                <th width="10"></th>
                <th><a href="?sort=nr&dir=desc"></i> Nr</a></th>
                <th><a href="?sort=invoice_nr&dir=desc"></i> Hankija arve nr</a></th>
                <th><a href="?sort=date&dir=desc"></i> Kuupäev</a></th>
                <th><a href="?sort=due_date&dir=desc"></i> Tasumistähtaeg</a></th>
                <th class="text-right"><a href="?sort=date_diff&dir=desc"><i class="fa fa-caret-up"></i> Päevi</a></th>
                <th></th>
                <th><a href="?sort=company_name&dir=desc"></i> Hankija</a></th>
                <th class="text-right"><a href="?sort=balance&dir=desc"></i> Jääk</a></th>
                <th class="text-right"><a href="?sort=total&dir=desc"></i> Summa</a></th>
                <th></th>
                <th width="65" class="text-right">Staatus</th>
                <!-- 			<th></th> -->
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td>
                    <a href="/invoice/detail?id=66960&back="> 1</a>
                </td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td class="text-right">
                    5									</td>
                <td>
                    <i class="fa fa-exclamation-triangle fa-red"></i>
                </td>
                <td></td>
                <td class="text-right text-red"></td>
                <td class="text-right">6 €</td>
                <td class="text-right">
                </td>
                <td class="text-right">
                    <i class="fa fa-times-circle fa-red"></i>
                </td>
                <!--
                            <td width="10">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-dropdown dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Muuda</a></li>
                                        <li><a href="#">Kustuta</a></li>
                                    </ul>
                                </div>
                            </td>
                -->
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th class="text-right">Summa kokku:</th>
                <th class="text-right">9 464,32 €</th>
                <th></th>
                <th></th>
            </tr>
            </tbody>
        </table>
        <div class="right-content-footer">
            <div class="paginator-lk pull-left">lk 1 / 3</div>
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
<script>
    $(function() {
        $('#new-msg').click(function() {
            $('#messages').modal();
        })
    });
</script>
</body>
</html>

