Hej!

Klicka här för att återställa lösenordet på VFTK.se: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
