<html lang="en">
<!-- https://www.bootdey.com/snippets/view/team-user-resume#html -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
  integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
  integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

<?php
# IMPORT USER DATA
require_once('data.php');


# IMPORT AGE FUNCTIONS
require_once('functions.php');
?>
<body>
  <link rel="stylesheet" href="detail.css" />
  <title>
    ASE 230 -
    <?= $memberNames[$_GET['id']]['name']?>
  </title>
  <div class="container text-center mb-5">
    <h1>
      This is ASE 230 -
      <?= $memberNames[$_GET['id']]['name']?>
    </h1>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-md-6">
        <div class="mb-2">
          <img class="w-100" src="<?=$memberNames[$_GET['id']]['picture']?>">
        </div>
        <div class="mb-2 d-flex">
          <h4 class="font-weight-normal">
            <?= $memberNames[$_GET['id']]['name']?>
          </h4>
          <div class="social d-flex ml-auto">
            <p class="pr-2 font-weight-normal">
              Follow on:
            </p>
            <a href="<?=$memberNames[$_GET['id']]['instagram']?>" class="text-muted mr-1">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="<?=$memberNames[$_GET['id']]['linkedin']?>" class="text-muted">
              <i class="fab fa-linkedin"></i>
            </a>
          </div>
        </div>
        <div class="mb-2">
          <ul class="list-unstyled">
            <li class="media">
              <span class="w-25 text-black font-weight-normal">
                Dream Job:
              </span>
              <label class="media-body">
                <?php echo $memberNames[$_GET['id']]['dreamjob']?>
              </label>
            </li>
            <li class="media">
              <span class="w-25 text-black font-weight-normal">
                Dream Company:
              </span>
              <label class="media-body">
                <?php echo $memberNames[$_GET['id']]['dreamcompany'] ?>
              </label>
            </li>
            <li class="media">
              <span class="w-25 text-black font-weight-normal">
                Email:
              </span>
              <label class="media-body">
                <?php echo $memberNames[$_GET['id']]['email']?>
              </label>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-7 col-md-6 pl-xl-3">
        <h5 class="font-weight-normal">
          Introducing Me
        </h5>
        <p>
          <?php echo $memberNames[$_GET['id']]['introduction']?>
        </p>
        <div class="my-2 bg-light p-2">
          <p class="font-italic mb-0">
            <?php echo $memberNames[$_GET['id']]['quote']?>
          </p>
        </div>
        <div class="mb-2 mt-2 pt-1">
          <h5 class="font-weight-normal">
            Top skills
          </h5>
        </div>
        <div class="py-1">
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width:85%" aria-valuenow="85" aria-valuemin="0"
              aria-valuemax="100">
              <div class="progress-bar-title">
                <?php echo $memberNames[$_GET['id']]['skill1']?>
              </div>
              <span class="progress-bar-number"></span>
            </div>
          </div>
        </div>
        <div class="py-1">
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width:70%" aria-valuenow="70" aria-valuemin="0"
              aria-valuemax="100">
              <div class="progress-bar-title">
                <?php echo $memberNames[$_GET['id']]['skill2']?>
              </div>
              <span class="progress-bar-number"></span>
            </div>
          </div>
        </div>
        <div class="py-1">
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width:77%" aria-valuenow="77" aria-valuemin="0"
              aria-valuemax="100">
              <div class="progress-bar-title">
                <?php echo $memberNames[$_GET['id']]['skill3']?>
              </div>
              <span class="progress-bar-number"></span>
            </div>
          </div>
        </div>
        <h5 class="font-weight-normal">
          Fun Fact:
        </h5>
        <p>
          <?php echo $memberNames[$_GET['id']]['funfact']?>
          <li class="media">
            <span class="w-25 text-black font-weight-normal">
              Age:
            </span>
            <label class="media-body">
              <?php $tempAge = $memberNames[$_GET['id']]['dob'];
                echo calcAge($tempAge);?>
            </label>
          </li>
          <li class="media">
            <span class="w-25 text-black font-weight-normal">
              I was born:
            </span>
            <label class="media-body">
              <?php $tempAge = $memberNames[$_GET['id']]['dob'];
                echo calcTimeAlive($tempAge);?>
            </label>
          </li>
        </p>
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">
              Home Page
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>
</body>
</html>