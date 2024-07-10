<x-layout>
    <div class="container forget-password" style="margin-top: 250px; margin-bottom: 250px">
        <div class="row">
            <div class="col-md-12 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <img src="https://usa.afsglobal.org/SSO/SelfPasswordRecovery/images/send_reset_password.svg?v=3"
                                alt="car-key" border="0">
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>You can reset your password here.</p>
                            <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="form-control" id="sel1">
                                            <option selected="true" disabled="disabled">Please Select Security Question
                                            </option>
                                            <option>Which is your favorite movie?</option>
                                            <option>What is your pet's name?</option>
                                            <option>What is the name of your village?</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="forgetAnswer" name="forgetAnswer" placeholder="Answer"
                                            class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="btnForget" class="btn btn-lg btn-primary btn-block btnForget"
                                        value="Reset Password" type="submit">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
