<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index">本けんさっくん</a>

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>
      </ul>
      <form action="search" method="post" class="d-flex">
        <?php 
        if (isset($_POST["params"])) {
          $placeholder = $_POST["params"] ?: "Search";
        } else {
          $placeholder = "検索";
        }
        
        ?>
        <input class="form-control me-2" type="search" name="params" placeholder="<?php echo $placeholder; ?>">
        <button class="btn btn-outline-success" type="submit" name="submit" value="title">Search</button>
      </form>
  </div>
</nav>