<!-- PHP -->

<?php
// Starting the session
session_start();
include('db.php');

    if (isset($_SESSION['email']) AND isset($_SESSION['password'])) 
    {
        header("Location:home.php");
        // To check if the user is logged in 
    }

    if(@isset($_GET[‘registered’]))
    {
  echo "Account created successfully! Use your username and password to login and setup your profile"; 
        // Alert after the succesfull signup
    }



   if( array_key_exists('email', $_POST) AND array_key_exists('password', $_POST) AND isset($_POST['submitbtn']) )
      
   {
        $password = mysqli_real_escape_string($link,$_POST['password']); 
        $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
                
                    $result = mysqli_query($link, $query);
                    $count = mysqli_num_rows($result);
                   
                    // To check if the row exists
                    if($count>0)
                    
                    {
                        $row = mysqli_fetch_assoc($result);
                
                        if (isset($row)) {
                        // To store the hashed password in a variable
                            $hash = $row['password'];

                        // PHP function to verify the POST Password and Hashed & Stored Password
                        if (password_verify($password,$row['password'])) 
                        {
                            // Creating sesssion variables for later validation and use
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['email'] = $_POST['email'];
                            $_SESSION['password'] = $_POST['password'];

                            // Creating a session for 30 minutes
                            $_SESSION['start'] = time(); 
                            $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
                            header("Location: home.php");
                            

                        } else {

                            $error = "That email/password combination could not be found.";
                            echo $error;


                        }
                    }
                }
                                            
  }
                                              
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>cHive</title>
    <!--FAVICON-->
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="{{"/img/favicon.ico" | relURL}}" type="image/x-icon" />
    <link rel="icon" href="{{"/img/favicon.ico" | relURL}}" type="image/x-icon" />
    <!--Type IT JS-->
    <script src="https://cdn.jsdelivr.net/npm/typeit@VERSION_NUMBER/dist/typeit.min.js"></script>
    <script src="/js/typeit.min.js"></script>
    <script src="/js/typeit.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.16/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/index.css" rel="stylesheet">

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Six+Caps" rel="stylesheet">

    <!--Navbar-->
    <nav class="navbar navbar-transparent fixed-top navbar-expand-lg animated fadeInDown" style=" color:white;" id="nav">

        <!-- Navbar brand -->
        <a class="navbar-brand" style="color:#1c2331;
        font-size:1.8rem; font-family: 'Ropa Sans',
        sans-serif;" href="#"
            id="lg">cHive</a>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
            aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

            <!-- Links -->
                <ul class="navbar-nav mr-auto" >
                 <li class="nav-item ">
                    <a class="nav-link" style="color: #1c2331;"href="./contact.php" id="cn">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #1c2331;"href="./about.php" id="ab">About Us</a>
                </li>
                
            </ul>
            <!-- Links -->

            <form class="form-inline">
                <a class="btn cbtn" href="" data-toggle="modal" data-target="#modalLoginForm"role="button" style=" border-radius: 25px;font-family: 'Roboto condensed',
        sans-serif;"
                    id="sgbtn">Sign In</a>
            </form>
        </div>
        <!-- Collapsible content -->

    </nav>
    <!--/.Navbar-->
    <style>
    #lgbtn{
        border: 1px solid #1c2331;
    }

     #lgbtn:hover{
        border: 1px solid #fff;
        color:white;
    }
    </style>
</head>

<body>

    <!-- Start your project here-->
    <!-- Intro -->

    <div class="view h-auto w-auto  d-inline-block">
        <img src="/img/header.png" class="img-fluid" id="img" alt="Background">
        <div class="mask flex-center rgba-indigo-sllight">
            <div class="mask pattern">
                <div class="white-text py-5 px-4 my-5 row">
                    <div class="col-sm">
                        <h1 id="head" class="card-title h1-responsive pt-3 mb-5 font-bold animated fadeInRight" style="">codersHive</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm">
                        <p class="mx-6 mb-6 animated fadeInRight" style="color: #eeecec;" id="ssubhead">
                            What does our commnunity do ?
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">

                        <br>
                        <p class="mx-6 mb-6 animated fadeInRight" style="color: #eeecec;" id="subhead">
                            We familiarise students with stronger and newer developer tools <br> that are required
                            to
                            create
                            powerful softwares.<br> Access
                            to better tools and resources will <br>lead students to experiment inquisitively. <br>In
                            layman
                            terms cHive is learning
                            whilst experimenting.

                        </p>

                    </div>
                </div>


                <!-- Button trigger modal -->
                <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold" style="color:#0f1521;">Sign
                                    in to your account</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- Form -->
                            <form class="text-center" style="color: #757575;" method="POST">
                                <div class="modal-body mx-3">
                                    <div class="md-form mb-5">
                                        <input type="email" id="defaultForm-email" class="form-control validate email" name="email"
                                            required>
                                        <label data-error="wrong" data-success="right" for="defaultForm-email">Your
                                            email</label>
                                    </div>

                                    <div class="md-form mb-4">
                                        <input type="password" id="defaultForm-pass" class="form-control validate password" name="password"
                                            required>
                                        <label data-error="wrong" data-success="right" for="defaultForm-pass">Your
                                            password</label>
                                    </div>
                                      
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                   <button class="btn cbtn btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="submitbtn" style="width:150px; margin-left:4%; " id="lgbtn">Login
                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="row" style="margin-top:1.5%;">
                    <div class="col-sm">
                        <a href="./signup.php" class="btn btn-rounded mb-5 cbtn animated fadeInUp" 
                            id="sbtn">Join Us</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>
     <!--MODAL -->
    <div class="container" id="here">
        <!-- Section: Greatness START -->
        <section id="info" class="text-center my-5">

            <!-- Section heading -->
            <h2 class="h1-responsive font-weight-bold my-5"style="font-size:2.8rem; font-family: 'Ropa Sans',
        sans-serif;">Why is it so great?</h2>
            <!-- Section description -->
            <p class="lead grey-text w-responsive mx-auto mb-5">A proper platform with codes is provided by cHive
                coding
                codes what's running in your mind, Don't let codes make you a puzzle start enjoying with coders
                union
                you will
                be
                coding your mind yourself.</p>

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-4">

                    <i class="fa fa-area-chart fa-3x red-text"></i>
                    <h5 class="font-weight-bold my-4">Analytics</h5>
                    <p class="grey-text mb-md-0 mb-5">We did a survey with some of the students of different places
                        and
                        we got to
                        make a
                        union for every students they really wanted to do projects and coding.
                    </p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4">

                    <i class="fa fa-book fa-3x cyan-text"></i>
                    <h5 class="font-weight-bold my-4">Tutorials</h5>
                    <p class="grey-text mb-md-0 mb-5">We are providing different projects new types of questions
                        and
                        also weekly
                        quizes to
                        develop your knowledge.
                    </p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4">

                    <i class="fa fa-comments-o fa-3x orange-text"></i>
                    <h5 class="font-weight-bold my-4">Support</h5>
                    <p class="grey-text mb-0">Your support will be given to us by getting involved into it with
                        your
                        new ideas.
                        with your
                        knowledge and solving assesments.
                    </p>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </section>
        <!-- Section: Greatness END -->
    </div>



    <!-- Footer -->
    <footer class="page-footer font-small unique-color-dark">

        <div style="background-color: #4842B7;">
            <div class="container">

                <!-- Grid row-->
                <div class="row py-4 d-flex align-items-center">

                    <!-- Grid column -->
                    <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
                        <h6 class="mb-0">Get connected with us on social networks!</h6>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-6 col-lg-7 text-center text-md-right">

                        <!-- Facebook -->
                        <a class="fb-ic">
                            <i class="fa fa-facebook white-text mr-4"> </i>
                        </a>
                        <!-- Twitter -->
                        <a class="tw-ic">
                            <i class="fa fa-twitter white-text mr-4"> </i>
                        </a>
                        <!-- Google +-->
                        <a class="gplus-ic">
                            <i class="fa fa-google-plus white-text mr-4"> </i>
                        </a>
                        <!--Linkedin -->
                        <a class="li-ic">
                            <i class="fa fa-linkedin white-text mr-4"> </i>
                        </a>
                        <!--Instagram-->
                        <a class="ins-ic">
                            <i class="fa fa-instagram white-text"> </i>
                        </a>

                    </div>
                    <!-- Grid column -->

                </div>
                <!-- Grid row-->

            </div>
        </div>

        <!-- Footer Links -->
        <div class="container text-center text-md-left mt-5">

            <!-- Grid row -->
            <div class="row mt-3">

                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

                    <!-- Content -->
                    <h6 class="text-uppercase font-weight-bold">codersHive</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p style="font-family: 'Playfair Display', serif;"><q>When inclusion is done right innovation is the outcome</q></p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

                    <!-- Links -->
                    <h6 class="text-uppercase font-weight-bold">Useful links</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                                    <p>
                                    <!-- Button trigger modal -->
                <a class="" data-toggle="modal" data-target="#exampleModal">
                Privacy Policy
                </a>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color:black;padding:1%;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header" style="color:white;background:#4842B7;">
                        <h2 class="modal-title" id="exampleModalLabel">Privacy Policy</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                <p>Effective date: January 02, 2019</p>


                <p>codersHive ("us", "we", or "our") operates the codershive.com website (the "Service").</p>

                <p>This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service and the choices you have associated with that data. </p>

                <p>We use your data to provide and improve the Service. By using the Service, you agree to the collection and use of information in accordance with this policy. Unless otherwise defined in this Privacy Policy, terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, accessible from codershive.com</p>


                <h2>Information Collection And Use</h2>

                <p>We collect several different types of information for various purposes to provide and improve our Service to you.</p>

                <h3>Types of Data Collected</h3>

                <h4>Personal Data</h4>

                <p>While using our Service, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you ("Personal Data"). Personally identifiable information may include, but is not limited to:</p>

                <ul>
                <li>Email address</li><li>First name and last name</li><li>Cookies and Usage Data</li>
                </ul>

                <h4>Usage Data</h4>

                <p>We may also collect information how the Service is accessed and used ("Usage Data"). This Usage Data may include information such as your computer's Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that you visit, the time and date of your visit, the time spent on those pages, unique device identifiers and other diagnostic data.</p>

                <h4>Tracking & Cookies Data</h4>
                <p>We use cookies and similar tracking technologies to track the activity on our Service and hold certain information.</p>
                <p>Cookies are files with small amount of data which may include an anonymous unique identifier. Cookies are sent to your browser from a website and stored on your device. Tracking technologies also used are beacons, tags, and scripts to collect and track information and to improve and analyze our Service.</p>
                <p>You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.</p>
                <p>Examples of Cookies we use:</p>
                <ul>
                    <li><strong>Session Cookies.</strong> We use Session Cookies to operate our Service.</li>
                    <li><strong>Preference Cookies.</strong> We use Preference Cookies to remember your preferences and various settings.</li>
                    <li><strong>Security Cookies.</strong> We use Security Cookies for security purposes.</li>
                </ul>

                <h2>Use of Data</h2>
                    
                <p>codersHive uses the collected data for various purposes:</p>    
                <ul>
                    <li>To provide and maintain the Service</li>
                    <li>To notify you about changes to our Service</li>
                    <li>To allow you to participate in interactive features of our Service when you choose to do so</li>
                    <li>To provide customer care and support</li>
                    <li>To provide analysis or valuable information so that we can improve the Service</li>
                    <li>To monitor the usage of the Service</li>
                    <li>To detect, prevent and address technical issues</li>
                </ul>

                <h2>Transfer Of Data</h2>
                <p>Your information, including Personal Data, may be transferred to — and maintained on — computers located outside of your state, province, country or other governmental jurisdiction where the data protection laws may differ than those from your jurisdiction.</p>
                <p>If you are located outside India and choose to provide information to us, please note that we transfer the data, including Personal Data, to India and process it there.</p>
                <p>Your consent to this Privacy Policy followed by your submission of such information represents your agreement to that transfer.</p>
                <p>codersHive will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this Privacy Policy and no transfer of your Personal Data will take place to an organization or a country unless there are adequate controls in place including the security of your data and other personal information.</p>

                <h2>Disclosure Of Data</h2>

                <h3>Legal Requirements</h3>
                <p>codersHive may disclose your Personal Data in the good faith belief that such action is necessary to:</p>
                <ul>
                    <li>To comply with a legal obligation</li>
                    <li>To protect and defend the rights or property of codersHive</li>
                    <li>To prevent or investigate possible wrongdoing in connection with the Service</li>
                    <li>To protect the personal safety of users of the Service or the public</li>
                    <li>To protect against legal liability</li>
                </ul>

                <h2>Security Of Data</h2>
                <p>The security of your data is important to us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security.</p>

                <h2>Service Providers</h2>
                <p>We may employ third party companies and individuals to facilitate our Service ("Service Providers"), to provide the Service on our behalf, to perform Service-related services or to assist us in analyzing how our Service is used.</p>
                <p>These third parties have access to your Personal Data only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.</p>

                <h3>Analytics</h3>
                <p>We may use third-party Service Providers to monitor and analyze the use of our Service.</p>    
                <ul>
                        <li>
                        <p><strong>Google Analytics</strong></p>
                        <p>Google Analytics is a web analytics service offered by Google that tracks and reports website traffic. Google uses the data collected to track and monitor the use of our Service. This data is shared with other Google services. Google may use the collected data to contextualize and personalize the ads of its own advertising network.</p>
                        <p>You can opt-out of having made your activity on the Service available to Google Analytics by installing the Google Analytics opt-out browser add-on. The add-on prevents the Google Analytics JavaScript (ga.js, analytics.js, and dc.js) from sharing information with Google Analytics about visits activity.</p>                <p>For more information on the privacy practices of Google, please visit the Google Privacy & Terms web page: <a href="https://policies.google.com/privacy?hl=en">https://policies.google.com/privacy?hl=en</a></p>
                    </li>
                                            </ul>


                <h2>Links To Other Sites</h2>
                <p>Our Service may contain links to other sites that are not operated by us. If you click on a third party link, you will be directed to that third party's site. We strongly advise you to review the Privacy Policy of every site you visit.</p>
                <p>We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</p>


                <h2>Children's Privacy</h2>
                <p>Our Service does not address anyone under the age of 18 ("Children").</p>
                <p>We do not knowingly collect personally identifiable information from anyone under the age of 18. If you are a parent or guardian and you are aware that your Children has provided us with Personal Data, please contact us. If we become aware that we have collected Personal Data from children without verification of parental consent, we take steps to remove that information from our servers.</p>


                <h2>Changes To This Privacy Policy</h2>
                <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</p>
                <p>We will let you know via email and/or a prominent notice on our Service, prior to the change becoming effective and update the "effective date" at the top of this Privacy Policy.</p>
                <p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>


                <h2>Contact Us</h2>
                <p>If you have any questions about this Privacy Policy, please contact us:</p>
                <ul>
                        <li>By email: codershive2019@gmail.com</li>
                        
                        </ul>
                    </div>
                    <div class="modal-footer" style="background: #4842B7;">
                        
                    </div>
                    </div>
                </div>
                </div>
                    </p>
             <p>
         <!-- Button trigger modal -->
                    <a data-toggle="modal" data-target="#exampleModal1">
                    Terms & Conditions
                        </a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document" style="color:black; padding:1%;">
                        <div class="modal-content">
                        <div class="modal-header" style="color:white;background:#4842B7;">
                            <h2 class="modal-title" id="exampleModalLabel">Terms and Conditions ("Terms")</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"style="color:white;">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                  
                <p>Last updated: January 02, 2019</p>


                <p>Please read these Terms and Conditions ("Terms", "Terms and Conditions") carefully before using the codershive.com
                    website (the "Service") operated by codershive ("us", "we", or "our").</p>

                <p>Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These
                    Terms apply to all visitors, users and others who access or use the Service.</p>

                <p>By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms
                    then you may not access the Service. </p>


                <h2>Accounts</h2>

                <p>When you create an account with us, you must provide us information that is accurate, complete, and current at all
                    times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your
                    account on our Service.</p>

                <p>You are responsible for safeguarding the password that you use to access the Service and for any activities or
                    actions under your password, whether your password is with our Service or a third-party service.</p>

                <p>You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of
                    any breach of security or unauthorized use of your account.</p>


                <h2>Links To Other Web Sites</h2>

                <p>codershive has no control over, and assumes no responsibility for, the content, privacy policies, or practices of
                    any third party web sites or services. You further acknowledge and agree that codershive shall not be responsible
                    or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with
                    use of or reliance on any such content, goods or services available on or through any such web sites or services.</p>

                <p>We strongly advise you to read the terms and conditions and privacy policies of any third-party web sites or
                    services that you visit.</p>


                <h2>Termination</h2>

                <p>We may terminate or suspend access to our Service immediately, without prior notice or liability, for any reason
                    whatsoever, including without limitation if you breach the Terms.</p>

                <p>All provisions of the Terms which by their nature should survive termination shall survive termination, including,
                    without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>

                <p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever,
                    including without limitation if you breach the Terms.</p>

                <p>Upon termination, your right to use the Service will immediately cease. If you wish to terminate your account, you
                    may simply discontinue using the Service.</p>

                <p>All provisions of the Terms which by their nature should survive termination shall survive termination, including,
                    without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>


                <h2>Governing Law</h2>

                <p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any
                    provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms
                    will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede
                    and replace any prior agreements we might have between us regarding the Service.</p>


                <h2>Changes</h2>

                <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is
                    material we will try to provide at least 7 days notice prior to any new terms taking effect. What constitutes a
                    material change will be determined at our sole discretion.</p>

                <p>By continuing to access or use our Service after those revisions become effective, you agree to be bound by the
                    revised terms. If you do not agree to the new terms, please stop using the Service.</p>

                <h2>Users</h2>

                <p>We are an intermediary, we would not be responsible for safeguarding anything you post.</p>

                <p>We are not responsible for the actions of other users.</p>

                <h2>Contact Us</h2>

                <p>If you have any questions about these Terms, please contact us.</p>
                                        </div>
                        <div class="modal-footer" style="background: #4842B7;">
                            
                        </div>
                        </div>
                    </div>
                    </div>
                    </p>
                    <p>
                        <a href="#!">Frequently Asked<br> Questions</a>
                    </p>
                    <p>
                        <a href="contact.html">Help</a>
                    </p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

                    <!-- Links -->
                    <h6 class="text-uppercase font-weight-bold">Contact</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>
                        <i class="fa fa-home mr-3"></i> GLS University , Ahmedabad</p>
                    <p>
                        <i class="fa fa-envelope mr-3"></i> codershive@gmail.com</p>
                    <p>
                        <i class="fa fa-phone mr-3"></i> + 1800-CODERS-HIVE</p>


                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3"><strong> © 2018 codersHive</strong>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->

    <!-- End your project here-->

    <!-- SCRIPTS --> 
             <script type="text/javascript">
                new TypeIt('#ssubhead', {
                strings: ["This is a great string.", "But here is a better one."],
                speed: 40,
                breakLines: false,
                autoStart: false,
                cursor: false

                });
            new TypeIt('#subhead', {
                strings: ["This is a great string.", "But here is a better one."],
                speed: 80,
                breakLines: false,
                autoStart: false,
                loop: true


                 });
            </script>
            
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.16/js/mdb.min.js"></script>



</body>

</html>