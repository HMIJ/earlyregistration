const functions = require('firebase-functions');
const axios = require('axios');

// Trigger Firebase Function when a new student is added to Firestore
exports.sendEmailOnNewStudent = functions.firestore.document('students/{studentId}')
    .onCreate((snap, context) => {
        const studentData = snap.data();
        const email = studentData.email;
        const fullname = studentData.fullname;

        // Call your external PHP API to send email with PHPMailer
        return axios.post('https://your-php-server.com/send_email.php', {
            email: email,
            fullname: fullname
        })
        .then(response => {
            console.log('Email sent successfully:', response.data);
        })
        .catch(error => {
            console.error('Error sending email:', error);
        });
    });
