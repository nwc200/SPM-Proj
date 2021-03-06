<?php
    require_once "objects/autoload.php";
    $username = $_SESSION['username'];
    $courseid= $_GET["courseid"];
    $dao = new QuizDAO();
    $course = $dao->getTrainerCourse($username);
    $class1 = $dao->getClassSectionQuiz($username, $courseid);
    $classid = $class1->getClassID();
    $classstudentnum = $dao->getClassStudentNum($classid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>Create Quiz Homepage</title>
</head>
<body>
    <div class="container" id="app">
        <div class="row">
            <div class="col-sm-12">
                <h1>Welcome {{username}}</h1>
                <h4>Your Class Information</h4>
                <b>ClassID:</b> {{class1[0]}}<br>
                <b>ClassSize:</b> {{classstudentnum}} out of {{class1[1]}} <br>
                <b>Class Start:</b> {{class1[3]}}, {{getDate()}} <br>
                <b>Class End:</b> {{class1[4]}}, {{getDate2()}} <br>
                <hr>
                <div v-for="(sectioninfo, index1) in class1[9]"> 
                    <b>Section Number:</b> {{sectioninfo[0]}} <br>
                    <b>Section Name:</b> {{sectioninfo[1]}}
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Num</th>
                                <th scope="col">Title</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Type</th>
                                <th scope="col">View Quiz</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(quizinfo,index) in sectioninfo[3]">
                                <td scope="col">{{index+1}}</th>
                                <td scope="col">{{quizinfo[1]}}</th>
                                <td scope="col">{{quizinfo[3]}} mins</th>
                                <td scope="col">{{quizinfo[4]}} </th>
                                <td scope="col"><a class="btn btn-primary" v-if="quizinfo[0]" v-bind:href="'../ViewQuiz.php?quizid='+quizinfo[0]" >View Quiz</a> </th>
                            </tr>
                        </tbody>
                    </table>
                    <div v-for="(quizinfo,index) in sectioninfo[3]">
                        <div v-if="quizinfo[4]=='Graded'">
                            {{changeChecker()}}
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-primary" v-if="sectioninfo[3].length==0 && index1 !=class1[9].length-1" v-bind:href="'../CreateUngradedQuiz.php?classid='+class1[0]+'&sectionnum='+sectioninfo[0]+'&quiznum=' + (sectioninfo[3].length+1)" role="button">Add Ungraded Quiz</a>
                    <a class="btn btn-primary" v-if="sectioninfo[3].length==0 && index1 !=class1[9].length-1" v-bind:href="'../ImportQuiz.php?classid='+class1[0]+'&sectionnum='+sectioninfo[0]+'&quiznum=' + (sectioninfo[3].length+1) + '&courseid='+ courseid" role="button">Import Ungraded Quiz</a>
                    <a class="btn btn-primary" v-if="index1 == class1[9].length-1 && checker ==0" v-bind:href="'../CreateGradedQuiz.php?classid='+class1[0]+'&sectionnum='+sectioninfo[0]+'&quiznum=' + (sectioninfo[3].length+1)" >Add Graded Quiz</a>
                    <br><br>
                </div>
                <br><br><br>

            </div>
        </div>
    </div>


    <script>
        var app = new Vue({
            el: "#app",
            data:{
                class1: <?php print json_encode($class1)?>,
                username: <?php print json_encode($username)?>,
                counter:0,
                classstudentnum: <?php print json_encode($classstudentnum)?>,
                checker:0,
                courseid: <?php print json_encode($courseid)?>
            },
            methods:{
                getDate: function(){
                    return this.class1[5].substring(0,5) 
                },
                getDate2: function(){
                    return this.class1[6].substring(0,5) 
                },
                changeChecker: function(){
                    this.checker =1
                }
            }
        })
        
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>