<?php 
          require_once('header.php');

?>
<style>
.action-bbtn {
	display: inline-block;
	padding: 1px 17px;
	text-align: center;
	background: #bb0000b8;
	color: #fff;
	border-radius: 13px;
     transition : .4s;
}
.action-bbtn:hover {
	color: #000;
     background: #ec0303;
}
</style>

<main class="main_content pt-5">
     <div class="container">
          <div class="row justify-content-center">
               <div class="col-lg-10">
                    <table class="table">
                         <thead>
                              <tr>
                                   <th>#</th>
                                   <th>Name</th>
                                   <th>Mobile No</th>
                                   <th>Email</th>
                                   <th>User Type</th>
                                   <th>Action</th>
                              </tr>
                         </thead>
                         <tbody>
                         <?php 
                              $i = 1;
                              $alif=$pdo->prepare("SELECT * FROM ejournal_users WHERE user_role=?");
                              $alif->execute(array("Reviewer"));
                              $all_result = $alif->fetchAll(PDO::FETCH_ASSOC);
                              foreach ($all_result as $row) :
                         ?>
                              <tr>
                                   <td scope="row"><?php echo $i++ ; ?></td>
                                   <td><?php echo $row['fname'].' '.$row['lname']; ?></td>
                                   <td><?php echo $row['mobile']; ?></td>
                                   <td><?php echo $row['email']; ?></td>
                                   <td><?php echo $row['user_role']; ?></td>
                                   <td> <a href="delete-user.php?uid=<?php echo $row['user_id']; ?>" class="action-bbtn" onclick='alert("Are you Sure!")'> <i class="fas fa-trash-alt    "></i> </a> </td>
                              </tr>
                         <?php endforeach; ?>
                             
                         </tbody>
                    </table>
               </div>
          </div>
     </div>
</main>


<?php require_once('footer.php'); ?>