window.onload = function () {   

    var check = document.getElementById("query")
    var url = document.getElementById("url")
    var template = document.getElementById("template")
    var answer = document.getElementById("response")
    var body 


    url.value = 'http://journal118/api/editProfile.php' 
    template.value = '6' 
    

    check.onclick = function () {
        switch (parseInt(template.value)) {
            case 1:
                body = {
                    name:'Артём',
                    surname:'Синотов',
                    login:'Yugun',
                    email:'dsdhsjkf@fdsfsk.ru',
                    pass:'12345',
                    repass:'12345',
                }
                break;
            case 2:
                body = {            
                    login:'Sinot',           
                    pass:'12345',            
                }
                break;  
                
            case 3:
                body = { 
                    token:'$2y$10$G.xqETsERSIZrAuUwj2S.O932SEzaXdkECYSj7KYw2bDlV9DSoomi',            
                }
                break; 
                
            case 4:
                body = { 
                    token:'$2y$10$G.xqETsERSIZrAuUwj2S.O932SEzaXdkECYSj7KYw2bDlV9DSoomi',            
                    count_duty:2,
                }
                break; 

            case 5:
                body = { 
                    token:'$2y$10$G.xqETsERSIZrAuUwj2S.O932SEzaXdkECYSj7KYw2bDlV9DSoomi',            
                    date_id:21,
                }
                break; 

            case 6:
                body = { 
                    token:'$2y$10$8kRhtFQYiknjz4bVwUy.fuz5y1Ns26bQFT/ICcq0p2tWFIq3OJHAG',            
                    name:'Артём',
                    surname:'Синотов',
                    login:'Sinot',
                    email:'dsdhsjkf@fdsfsk.ru',
                    pass:'ubopol12',
                    newpass:'ubopol12',
                    repass:'ubopol12',
                }
                break; 
                
            default:
                body = {}
                break;
        }

        sendQuery(url.value,'POST',body).then(awr => print(awr,answer))
        .catch(error => console.error(error))
    }
}

function sendQuery(url,method,body) {
    return fetch(url,{
        method,
        body:JSON.stringify(body),
        headers:{
            'Content-Type':'application/json'
        }
    }).then(response => {
        return new Promise((resolve,reject) => {            
            if(response.ok){
                resolve(response.json())
            }
            reject({
                error:true,
                error_num:322,
                error_info:'Что-то пошло не так',
            })
        })
    })
}

function print(message,stream) {
    stream.innerHTML = JSON.stringify(message)
    console.log(message)
}
