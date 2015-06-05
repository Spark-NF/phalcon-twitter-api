<h2>Sign up using this form</h2>
{{ form('signup/register') }}
    <fieldset>
        <div>
            <label for="email">Username</label>
            <div>
                {{ text_field('username') }}
            </div>
        </div>
        <div>
            <label for="email">Email</label>
            <div>
                {{ text_field('email') }}
            </div>
        </div>
        <div>
            <label for="password">Password</label>
            <div>
                {{ password_field('password') }}
            </div>
        </div>
        <div>
            {{ submit_button('Login') }}
        </div>
    </fieldset>
</form>