<html lang="en">
<!-- https://www.bootdey.com/snippets/view/team-user-resume#html -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
  integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
  integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />


<?php
# This is an array that stores all the information for each team member. 
$memberNames = [
  ['name'=> 'Chandler Farmer', 'dreamjob'=> 'Cybersecurity Risk & Compliance Leader', 'dreamcompany'=> 'Microsoft', 'email'=> 'farmerc4@mymail.nku.edu', 
  'introduction'=> 'My name is Chandler Farmer and I\'m a senior at Northern Kentucky University studying Cybersecurity. I\'m an Information Technology 
  Risk & Compliance Intern at American Modern Insurance Group. During my free time I enjoy working out, spending time with friends, and watching movies.',
  'quote'=> '"Learning never exhausts the mind" - Leonardo da Vinci', 'skill1'=> 'Computer Security', 'skill2'=> 'Computer Programming', 'skill3'=> 'Risk Management',
  'funfact'=> 'This summer I traveled to Gatlinburg Tennessee & Norris Lake (Tennessee). Over winter break I\'m traveling to Florida. Lastly, during spring break I\'m taking a cruise to the Bahamas.'
  , 'picture'=> 'grin smile.png', 'linkedin'=> 'https://www.linkedin.com/in/chandlerfarmer', 'instagram'=> 'https://www.instagram.com/chandler.farmer/'],

  ['name'=> 'Kaleb Alstott', 'dreamjob'=> 'Chief Information Security Officer', 'dreamcompany'=> 'Chainalysis', 'email'=> 'alstottk1@mymail.nku.edu', 'introduction'=> 'Hello everyone, my name is Kaleb Alstott. I am currently finishing out my junior year, starting my senior year at NKU. I am a double major in Cybersecurity and
  Communications. My dream goal is to work for a top tier Cybersecurity company taking
  place in New York. A little bit more about me is that I am currently working at Taste Of
  Belgium as a server in Crestview and absolutely love it! If you ever want to stop in for
  the best waffles and chicken in town, please let me know!', 'quote'=> '"What, so everyone\'s supposed to sleep every single night now? You realize that nighttime 
  makes up half of all time?" - Rick Sanchez, "Rick & Morty"', 'skill1'=> 'Coding', 'skill2'=> 'Networking', 'skill3'=> 'Communication', 'funfact'=> 'A fun fact about me is that I am a huge Chicago Cubs baseball fan. It is my goal every
  year to head to Chicago and be able to watch a game at Wrigley Field. This year I am
  lucky enough to have my girlfriend buy me tickets and have a weekend trip this
  upcoming October for the end of the baseball season. I am so excited and looking
  forward to this everyday!
  ', 'picture'=> 'https://bootdey.com/img/Content/avatar/avatar7.png', 'linkedin'=> 'https://www.linkedin.com/in/kaleb-alstott-126526221/', 'instagram'=> 'https://www.instagram.com/kaleba33/'],

  ['name'=> 'James Palovich', 'dreamjob'=> 'Cybersecurity SOC Analyst', 'dreamcompany'=> 'US Bank', 'email'=> 'palovichj1@mymail.nku.edu', 'introduction'=> 'Hey Everyone! I am James Palovich, I am a cybersecurity major with a junior standing, I am
  quite undesided on my plans once I graduate. I am open to work within the government
  in a cyber-related field, however, on the civilian side I am wanting to work as a SOC
  analyst because of its flexibility to work on-site or remote. Either way I do plan on
  pursuing a master in cybersecurity upon graduation. Outside of school I am a real estate
  agent and photographer working with Keller Williams. I have been in real estate for about
  a year and a half, I got into real estate because of my interest in real estate investing.', 'quote'=> '"The price is something 
  not necessarily defined as financial. It could be time, effort, sacrifice, money or perhaps, something else."', 'skill1'=> 'Threat Analysis', 'skill2'=> 'Networking', 'skill3'=> 'Incident Response'
, 'funfact'=> 'A fun fact about me is that I also serve in the Kentucky Army National Guard as a 17E
(Electronic Warfare Specialist) with the plans of pursuing chief warrant officer in Cyber
Warfare.', 'picture'=> 'https://bootdey.com/img/Content/avatar/avatar6.png', 'linkedin'=> 'https://www.linkedin.com/in/jamespalovich/', 'instagram'=> 'https://www.instagram.com/j.palovich/'],

  ['name'=> 'Daniel Santana', 'dreamjob'=> 'Cybersecurity Analyst', 'dreamcompany'=> 'Google', 'email'=> 'santanad2@nku.edu', 'introduction'=> 'I am a senior and a current cybersecurity major. I am originally from New York and
  came here for college as it was cheap and allowed me to see my brother who lives out
  here. I am in a fraternity and have enjoyed my time here while making some great
  friends and connections.', 'quote'=> '"Tough times never last but tough people do" - Robert H. Schuller', 'skill1'=> 'Programming', 'skill2'=> 'Networking', 'skill3'=> 'Education'
  , 'funfact'=> 'I am a big baseball fan, my favorite team is the New York Mets and you can always find
  a pendent of their team logo on my necklace.', 'picture'=> 'https://bootdey.com/img/Content/avatar/avatar2.png', 'instagram'=> 'www.instagram.com', 'linkedin'=> 'www.linkedin.com']
];
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