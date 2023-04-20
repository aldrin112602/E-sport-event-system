<?php
 session_start();
 if(!isset($_SESSION['unique_id']) && !isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'user') {
   header('location: ../');
 }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quizzes trivia</title>
  <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Prompt&display=swap');
  
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: "Prompt", sans-serif;
    }
    
    body {
      background: linear-gradient(purple, blue);
      background-repeat: no-repeat;
      }
      
      @media(min-width: 600px) {
        body {
          display: flex;
          align-items: center;
          justify-content: center;
          height: 100vh;
        }
      }
      #root {
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        border-radius: 10px;
      }
      ::-webkit-scrollbar {
        display: none;
     }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <div id="root" class="container overflow-auto p-4 bg-white"></div>
  <script type="text/babel">
    const quiz = [
      {
        question: " Where did Atlas go with Aurora Heart?",
        options: [ "The Abyss", "The Hell", "Cadia Riverland", "The World's End" ],
        answer_key: 'The Abyss'
      },
      {
        question: "What is the maximum number of emblems in the game?",
        options: [15, 10, 18, 16],
        answer_key: 16
      },
      {
        question: "How many heroes are there in Mobile Legends?",
        options: [75, 85, 50, 82],
        answer_key: 85
      },
      {
        question: "What do people call Franco?",
        options: ['The King of Northern Pirates', 'The Frozen Warrior', 'The Northern Valiant','The Frozen Weirdo'],
        answer_key: 'The Frozen Warrior'
      },
      {
        question: "What does Franco hate the most?",
        options: ['Jumping','Fighting','Dancing','Swimming'],
        answer_key: 'Swimming'
      },
     
      ]
      
      const App = () => {
        return (
          <>
           <a href="./homepage.php" className="nav-link">
            <li style={{ fontSize: '25px' }} className="fas text-primary fa-arrow-left"></li>
           </a>
           <img className="img-fluid" src="https://i.postimg.cc/hjZ1ty1L/undraw-Questions-re-1fy7.png" alt=""/>
           <h2>Quiz trivia</h2>
           <form id="form" onSubmit={ e => {
             e.preventDefault()
             let formData = new FormData(document.getElementById('form'))
             let i = 0, count_wrong_ans = 0;
             for(const [key, value] of formData.entries()) {
               if(value != quiz[i].answer_key) count_wrong_ans++;
               i++;
             }
             alert(`Congratulations,You got a score of ${quiz.length - count_wrong_ans} over ${quiz.length}!`);
             let request = new XMLHttpRequest();
             request.onload = () => {
               if(request.responseText == String(quiz.length - count_wrong_ans)) {
                 setTimeout(() => {
                   location.href = './homepage.php';
                 }, 1000)
               }
             }
             request.open('POST', './save-score.php', true);
             request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
             let url = new URLSearchParams()
             url.append('score', String(quiz.length - count_wrong_ans))
             url.append('items', String(quiz.length))
             request.send(url);
             
           }}>
             {
               quiz.map(function(obj, i) {
               return (
                  <div className="container-fluid my-4" key={i}>
                   <h6>{`${i + 1}.)`} {obj.question}</h6>
                   {
                    obj.options.map(function(option, _i) {
                     return (
                        <div key={_i} className="my-1 form-check">
                         <input required={true} className="form-check-input" type="radio" name={`opt_${i}`} value={option}/>
                         <label className="form-check-label">{option}</label>
                        </div>
                       )
                    })
                  }
                  </div>
                 )
              })
            }
             <div className='d-grid'>
               <button className='btn btn-block btn-primary border'>
                 Submit
               </button>
             </div>
           </form>
          </>
          )
      }
      const root = ReactDOM.createRoot(document.getElementById('root'));
      root.render(<App/>);
  </script>
</body>
</html>
