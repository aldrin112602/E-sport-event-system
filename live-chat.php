<?php
 session_start();
 if(!isset($_SESSION['unique_id']) && !isset($_SESSION['user_type'])) {
   header('location: ./');
 }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome to live chat</title>
  <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.2/axios.min.js" integrity="sha512-bHeT+z+n8rh9CKrSrbyfbINxu7gsBmSHlDCb3gUF1BjmjDzKhoKspyB71k0CIRBSjE5IVQiMMVBgCWjF60qsvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
      height: 100vh;
      }
      
      @media(min-width: 600px) {
        body {
          display: flex;
          align-items: center;
          justify-content: center;
        }
      }
      @media(max-width: 400px) {
        #root {
          height: 100vh;
        }
      }
      #root {
        max-width: 400px;
      }
  .msg {
     display: flex;
     width: 100%;
     margin: 10px 0;
   }
   .incoming {
     align-items: flex-start;
     position: relative;
   }
   .incoming span {
     background: rgba(0,0,10,0.1);
     border-radius: 0 5px 5px 5px;
     padding: 5px 10px;
     max-width: 70%;
     margin-top: 20px;
     margin-left: 10px;
     color: #222;
   }
   #msg-container span {
     word-wrap: break-word;
   }
   .outgoing {
     align-self: flex-end;
     flex-direction: row-reverse;
     position: relative;
   }
   .incoming small {
     position: absolute;
     left: 10px;
     top: 0;
   }
   .outgoing small {
     position: absolute;
     right: 10px;
     top: 0;
   }
    .outgoing span {
     background: #5C6AFF;
     border-radius: 5px 0 5px 5px;
     padding: 5px 10px;
     max-width: 70%;
     margin-top: 20px;
     margin-right: 10px;
     color: #fff;
   }
   img {
     box-shadow: 1px 1px 5px #eee;
     height: 40px;
     width: 40px;
     border-radius: 50%;
     object-fit: cover;
   }

  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
 </head>
<body>
  <div id="root" class="container overflow-hidden rounded p-4 bg-white border"></div>
  <script type="text/babel">
      const App = () => {
        const { useState } = React
        const [msg, setMsg] = useState('')
        let isLoadOnce = false
        const fetchMessages = () => {
          axios.get('./fetch-message.php')
           .then(res => {
             let e = document.getElementById('msg-container');
             if(!isLoadOnce) {
              e.innerHTML = res.data;
              e.scrollTop = e.scrollHeight;
              setTimeout(() => {
                isLoadOnce = true
              }, 1000)
             }
           });
        }
        fetchMessages();
        setInterval(fetchMessages, 2000);
        const sendMsg = (ev) => {
         ev.preventDefault()
         let e = document.getElementById('msg-container');
         e.scrollTop = e.scrollHeight;
         
         axios.post('./handle-message.php', `message=${msg}`)
         .then(res => {
           setMsg('')
           fetchMessages();
         })
         .catch(err => {
          setMsg('')
          alert('Send failed!');
         });
        }
        return (
          <>
           <div className='container-fluid py-4 border-bottom'>
              <a href='./' className='nav-link d-inline-block'><i className='fas fa-arrow-left text-primary' style={{fontSize: '20px'}}></i></a>
             <span style={{fontSize: '17px'}}>&nbsp;Welcome to Live Chat!</span>
           </div>
           <div id='msg-container' className='overflow-auto bg-light container-fluid border my-3' style={{minHeight: '400px', maxHeight: '500px'}}>
           </div>
           <form onSubmit={sendMsg} className='d-flex align-items-center justify-content-between'>
            <textarea value={msg} onChange={(e) => setMsg(e.target.value)} style={{height: '32px', marginRight: '10px'}} autoFocus={true} required placeholder='Write message..' className='form-control form-control-sm'></textarea>
            <button className='btn btn-primary btn-sm' type='submit'>Send</button>
           </form>
          </>
          )
      }
      
      const root = ReactDOM.createRoot(document.getElementById('root'));
      root.render(<App />);
  </script>
</body>
</html>
