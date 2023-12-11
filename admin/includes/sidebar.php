<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Members</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="view-member.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-group"></i></div>
                                List of Members
                            </a>
                            <div class="sb-sidenav-menu-heading">Main Work</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-toolbox"></i></div>
                                Logistics
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="view-logistics-list.php">List</a>
                                    <a class="nav-link" href="view-logistics-loan.php">Loan</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-swatchbook"></i></div>
                                Work Program
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="view-workprogram-list.php">List</a>
                                    <a class="nav-link" href="view-workprogram-meeting.php">Meeting</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Extension</div>
                            
                            <a class="nav-link" href="view-agenda.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-days"></i></div>
                                Agenda
                            </a>
                            <a class="nav-link" href="view-suggestion.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-inbox"></i></div>
                                Suggestion
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php
                        if (isset($_SESSION['auth_user']) && is_array($_SESSION['auth_user'])) {
                            echo $_SESSION['auth_user']['namalengkap'];
                        } else {
                            echo "User not logged in.";
                        }
                        ?>
                    </div>
                </nav>
            </div>