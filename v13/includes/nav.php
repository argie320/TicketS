<div id="navbar">
            	<div class="cssmenu">
            	
   					<a href='dashboard.php'><span>Dashboard</span></a>
   					<a href='myticket'><span>Tickets</span></a>
                    <?php
                    /*
                     * admin = 0,
                     * supervisor = 1,
                     * engineer = 2,
                     */
                    if(isset($access)){
                        switch($access){
                            case 0:
                                $grant = '<li class="last"><a href="workorder.php?id="><span>Work Order</span></a></li>';
                                break;
                            case 1:
                                $grant = '<li class="last"><a href="workorder.php?id="><span>Work Order</span></a></li>';
                                break;
                            case  2:
                                $grant = '';
                                break;
                        }
                    }
                echo $grant = '';

                    ?>

				</ul>
                </div>
</div>