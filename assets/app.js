/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import  axios  from 'axios';






document.addEventListener('DOMContentLoaded', function () {
    let i =0;
    let uuid = [];
    const option1 = {
        method: 'GET',
        url: 'https://api.calendly.com/scheduled_events',
        params: {
            organization: 'https://api.calendly.com/organizations/32026984-8c1e-430f-ad63-a102392f19a4',
            status: 'active',
            sort: 'start_time:asc',
            count: '100'
        },
        headers: {
            'Content-Type': 'application/json',
            Authorization: 'Bearer eyJraWQiOiIxY2UxZTEzNjE3ZGNmNzY2YjNjZWJjY2Y4ZGM1YmFmYThhNjVlNjg0MDIzZjdjMzJiZTgzNDliMjM4MDEzNWI0IiwidHlwIjoiUEFUIiwiYWxnIjoiRVMyNTYifQ.eyJpc3MiOiJodHRwczovL2F1dGguY2FsZW5kbHkuY29tIiwiaWF0IjoxNjYzMTM2OTg0LCJqdGkiOiI5MWEwMWNkMy1hYWZkLTRjNWYtYmY2NC03NmQxMWUxM2UwNTkiLCJ1c2VyX3V1aWQiOiJjMTYzNzUwYy1lZGMwLTQ2OTctOTgxYy1mNDMyOWMwYWZlN2EifQ.T4lZIfE2gnaJTMsgpYz9Rk6QJePI9UyfXUCJBYZ_s-b5wsqrQVu-RaViKVsx0thtzW1MJDhzVIan0sYw4hqx1g'
        }
    }
    axios(option1).then(function (response) {

        response.data.collection.forEach(  function (element, index, array) {
            // console.log(element.event_type,element.event_type.substring(element.event_type.lastIndexOf('/') + 1))
            axios.all([
                axios({
                    method: 'GET',
                    url: `https://api.calendly.com/scheduled_events/${element.uri.substring(element.uri.lastIndexOf('/') + 1)}/invitees`,
                    headers: {
                        'Content-Type': 'application/json',
                        Authorization: 'Bearer eyJraWQiOiIxY2UxZTEzNjE3ZGNmNzY2YjNjZWJjY2Y4ZGM1YmFmYThhNjVlNjg0MDIzZjdjMzJiZTgzNDliMjM4MDEzNWI0IiwidHlwIjoiUEFUIiwiYWxnIjoiRVMyNTYifQ.eyJpc3MiOiJodHRwczovL2F1dGguY2FsZW5kbHkuY29tIiwiaWF0IjoxNjYzMTM2OTg0LCJqdGkiOiI5MWEwMWNkMy1hYWZkLTRjNWYtYmY2NC03NmQxMWUxM2UwNTkiLCJ1c2VyX3V1aWQiOiJjMTYzNzUwYy1lZGMwLTQ2OTctOTgxYy1mNDMyOWMwYWZlN2EifQ.T4lZIfE2gnaJTMsgpYz9Rk6QJePI9UyfXUCJBYZ_s-b5wsqrQVu-RaViKVsx0thtzW1MJDhzVIan0sYw4hqx1g'
                    }
                }),
                axios({
                    method: 'GET',
                    url: `https://api.calendly.com/event_types/${element.event_type.substring(element.event_type.lastIndexOf('/') + 1)}`,
                    headers: {
                        'Content-Type': 'application/json',
                        Authorization: 'Bearer eyJraWQiOiIxY2UxZTEzNjE3ZGNmNzY2YjNjZWJjY2Y4ZGM1YmFmYThhNjVlNjg0MDIzZjdjMzJiZTgzNDliMjM4MDEzNWI0IiwidHlwIjoiUEFUIiwiYWxnIjoiRVMyNTYifQ.eyJpc3MiOiJodHRwczovL2F1dGguY2FsZW5kbHkuY29tIiwiaWF0IjoxNjYzMTM2OTg0LCJqdGkiOiI5MWEwMWNkMy1hYWZkLTRjNWYtYmY2NC03NmQxMWUxM2UwNTkiLCJ1c2VyX3V1aWQiOiJjMTYzNzUwYy1lZGMwLTQ2OTctOTgxYy1mNDMyOWMwYWZlN2EifQ.T4lZIfE2gnaJTMsgpYz9Rk6QJePI9UyfXUCJBYZ_s-b5wsqrQVu-RaViKVsx0thtzW1MJDhzVIan0sYw4hqx1g'
                    }
                })
            ])
                .then(axios.spread((response, data2) => {
                   

                    return {
                        "utilisateur": data2.data.resource.profile.name,
                        "uuid": element.event_memberships[0].user.substring(element.event_memberships[0].user.lastIndexOf('/') + 1),
                        "scheduled_events": element.uri.substring(element.uri.lastIndexOf('/') + 1),
                        'start_time': new Date(element.start_time).toString(),
                        'end_time': new Date(element.end_time).toString(),
                        "type d'evenement": element.name,
                        'email': response.data.collection[0].email,
                        'name': response.data.collection[0].name,
                        'first_name': response.data.collection[0].first_name,
                        'last_name': response.data.collection[0].last_name,
                        'question': response.data.collection[0].questions_and_answers

                    }



                })).then( async objet => {
                    uuid.push(objet)
                    i++
                   
                    if (i === array.length - 1) {
                     
                        console.log("Last callback call at index " + index +" " +  i+ " with value " + objet.email +i); 
                         console.log(uuid)
                        //  hello(uuid) 
                        
                    }



                })
        })
    })


    const hello =  (post) => {



        // console.log(post)

        axios.post('http://127.0.0.1:8000/ax', post
        ).then(response => {
  console.log(response.data)
        }).catch(error => {
            console.log(error);
        })

    }


})








/**************************************************************************************************************
 * ************************************************************************************************************
 */


/*******************************************************************************************************************/

