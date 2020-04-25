<!DOCTYPE html>
<html>
<head>
	<title>Super Admin Forgot Password | Stockpile</title>
	<style type="text/css">
		body {
              font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif; 
            }
	</style>
</head>
<body>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>







<script type="text/javascript">
	(async () => {

const { value: email } = await Swal.fire({
  title: 'Input Email Address',
  input: 'email',
  inputPlaceholder: 'Enter your email address'
})

if (email) {
  const { value: otp } = await Swal.fire({
  title: 'Input OTP',
  input: 'number',
  inputPlaceholder: 'Enter otp'
})
  if (otp) {
    Swal.fire(`Entered email: ${email}`)
  }
}

})()
	
</script>

<script type="text/javascript">
  /*
	Swal.mixin({
  input: 'text',
  confirmButtonText: 'Next &rarr;',
  showCancelButton: true,
  progressSteps: ['1', '2', '3']
}).queue([
  {
    title: 'Question 1',
    text: 'Chaining swal2 modals is easy'
  },
  'Question 2',
  'Question 3'
]).then((result) => {
  if (result.value) {
    const answers = JSON.stringify(result.value)
    Swal.fire({
      title: 'All done!',
      html: `
        Your answers:
        <pre><code>${answers}</code></pre>
      `,
      confirmButtonText: 'Lovely!'
    })
  }
})*/
</script>
</body>
</html>