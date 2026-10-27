<x-mail::message>
    Hai Kak {{ $data['name'] }}, <br><br>{!! $data['body'] !!}<br>
    <x-mail::subcopy>E-mail ini dikirim otomatis oleh sistem. Mohon untuk tidak membalasnya. Apabila kamu membutuhkan bantuan, silakan hubungi WhatsApp <a href="https://wa.me/6282143697692" target="_blank">6282143697692</a> atau Instagram <a href="https://www.instagram.com/routind.academy" target="_blank">@routind.academy</a>. Terima kasih.</x-mail::subcopy>
</x-mail::message>