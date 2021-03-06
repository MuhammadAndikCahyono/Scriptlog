<?php if (!defined('SCRIPTLOG')) exit(); ?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=(isset($pageTitle)) ? $pageTitle : ""; ?>
        <small>
        <a href="index.php?load=menu-child&action=newSubmenu&subMenuId=0" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
        </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?load=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="index.php?load=menu-child">All Submenus</a></li>
        <li class="active">Data Submenu</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
         <div class="col-xs-12">
         <?php 
         if (isset($errors)) :
         ?>
         <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
           <?php 
              foreach ($errors as $e) :
                echo $e;
              endforeach;
           ?>
          </div>
         <?php 
         endif;
         ?>
         
         <?php 
         if (isset($status)) :
         ?>
         <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
           <?php 
              foreach ($status as $s) :
                echo $s;
              endforeach;
           ?>
          </div>
         <?php 
         endif;
         ?>
         
            <div class="box box-primary">
               <div class="box-header with-border">
                <h3 class="box-title">
              <?=(isset($subMenusTotal)) ? $subMenusTotal : 0; ?> 
               Sub Menu<?=($subMenusTotal != 1) ? 's' : ''; ?>
               in Total  
              </h3>
               </div>
              <!-- /.box-header -->
              
              <div class="box-body">
               <table id="scriptlog-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Submenu</th>
                  <th>Parent</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                 <?php 
                   if (is_array($subMenus)) : 
                   $no = 0;
                   foreach ($subMenus as $sm => $subMenu) :
                   $no++;
                  ?>
              
                    <tr>
                       <td><?= $no; ?></td>
                       <td><?= htmlspecialchars($subMenu['menu_label']); ?></td>
                       <td><?= htmlspecialchars($subMenu['menu_link']); ?></td>
                       <td>
                        <?php if ($subMenu['menu_status'] === 'N') :?> 
                           disabled
                        <?php 
                           else :
                        ?>
                            enabled
                        <?php endif; ?>
                       </td>
                       <td>
                       <a href="index.php?load=menu-child&action=editMenu&subMenuId=<?= htmlspecialchars((int)$subMenu['ID']);?>" class="btn btn-warning">
                       <i class="fa fa-pencil fa-fw"></i> Edit</a>
                       </td>
                       <td>
                       <a href="javascript:deleteSubmenu('<?= abs((int)$subMenu['ID']); ?>', '<?= $subMenu['menu_label']; ?>')" class="btn btn-danger" title="Deactivate menu">
                       <i class="fa fa-trash-o fa-fw"></i> Delete</a>  
                       </td>
                    
                    </tr>
                
                <?php 
                endforeach;
                endif; 
                ?>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Menu</th>
                  <th>Link</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </tfoot>
              </table>
              </div>
                  <!-- /.box-body -->
            </div>
               <!-- /.box -->
         </div>
            <!-- /.col-xs-12 -->
      </div>
           <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
  
  function deleteSubmenu(id, menu)
  {
	  if (confirm("Are you sure want to delete Submenu '" + menu + "'"))
	  {
	  	window.location.href = 'index.php?load=menu-child&action=deleteSubmenu&subMenuId=' + id;
	  }
  }
  
</script>