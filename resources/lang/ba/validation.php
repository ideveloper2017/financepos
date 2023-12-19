<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute গ্রহণ করা আবশ্যক।',
    'active_url' => ':attribute একটি বৈধ URL নয়।',
    'after' => ':attribute তারিখটি :date এর পরে হতে হবে।',
    'after_or_equal' => ':attribute তারিখটি :date এর পরে বা সমান হতে হবে।',
    'alpha' => ':attribute শুধুমাত্র অক্ষর থাকতে পারে।',
    'alpha_dash' => ':attribute শুধুমাত্র অক্ষর, সংখ্যা, ড্যাশ এবং আন্ডারস্কোর থাকতে পারে।',
    'alpha_num' => ':attribute শুধুমাত্র অক্ষর এবং সংখ্যা থাকতে পারে।',
    'array' => ':attribute একটি অ্যারে হতে হবে।',
    'before' => ':attribute তারিখটি :date এর আগে হতে হবে।',
    'before_or_equal' => ':attribute তারিখটি :date এর আগে বা সমান হতে হবে।',
    'between' => [
        'numeric' => ':attribute :min এবং :max এর মধ্যে হতে হবে।',
        'file' => ':attribute :min এবং :max কিলোবাইটের মধ্যে হতে হবে।',
        'string' => ':attribute :min এবং :max অক্ষরের মধ্যে হতে হবে।',
        'array' => ':attribute :min এবং :max আইটেমের মধ্যে থাকতে হবে।',
    ],
    'boolean' => ':attribute ক্ষেত্রটি সত্য বা মিথ্যা হতে হবে।',
    'confirmed' => ':attribute নিশ্চিতকরণ মেলে না।',
    'date' => ':attribute একটি বৈধ তারিখ নয়।',
    'date_equals' => ':attribute তারিখটি :date এ সমান হতে হবে।',
    'date_format' => ':attribute বিন্যাস :format এর সাথে মেলে না।',
    'different' => ':attribute এবং :other ভিন্ন হতে হবে।',
    'digits' => ':attribute সংখ্যা :digits হতে হবে।',
    'digits_between' => ':attribute সংখ্যা :min এবং :max এর মধ্যে হতে হবে।',
    'dimensions' => ':attribute অবৈধ চিত্র মাত্রা রয়েছে।',
    'distinct' => ':attribute ক্ষেত্রের একটি ডুপ্লিকেট মৌলিক রয়েছে।',
    'email' => ':attribute একটি বৈধ ইমেল ঠিকানা হতে হবে।',
    'ends_with' => ':attribute নিম্নলিখিত একটির সাথে শেষ হতে হবে: :values।',
    'exists' => 'নির্বাচিত :attribute অবৈধ।',
    'file' => ':attribute একটি ফাইল হতে হবে।',
    'filled' => ':attribute ক্ষেত্রটির একটি মৌলিক থাকতে হবে।',
    'gt' => [
        'numeric' => ':attribute :value চেয়ে বড় হতে হবে।',
        'file' => ':attribute :value কিলোবাইট চেয়ে বড় হতে হবে।',
        'string' => ':attribute :value অক্ষর চেয়ে বড় হতে হবে।',
        'array' => ':attribute :value আইটেম চেয়ে বেশি থাকতে হবে।',
    ],
    'gte' => [
        'numeric' => ':attribute :value চেয়ে বড় বা সমান হতে হবে।',
        'file' => ':attribute :value কিলোবাইট চেয়ে বড় বা সমান হতে হবে।',
        'string' => ':attribute :value অক্ষর চেয়ে বড় বা সমান হতে হবে।',
        'array' => ':attribute এ অন্তত :value আইটেম থাকতে হবে।',
    ],
    'image' => ':attribute একটি চিত্র হতে হবে।',
    'in' => 'নির্বাচিত :attribute অবৈধ।',
    'in_array' => ':attribute ক্ষেত্র :other এর মধ্যে নেই।',
    'integer' => ':attribute একটি পূর্ণসংখ্যা হতে হবে।',
    'ip' => ':attribute একটি বৈধ IP ঠিকানা হতে হবে।',
    'ipv4' => ':attribute একটি বৈধ IPv4 ঠিকানা হতে হবে।',
    'ipv6' => ':attribute একটি বৈধ IPv6 ঠিকানা হতে হবে।',
    'json' => ':attribute একটি বৈধ JSON স্ট্রিং হতে হবে।',
    'lt' => [
        'numeric' => ':attribute :value চেয়ে ছোট হতে হবে।',
        'file' => ':attribute :value কিলোবাইট চেয়ে ছোট হতে হবে।',
        'string' => ':attribute :value অক্ষর চেয়ে ছোট হতে হবে।',
        'array' => ':attribute :value আইটেম চেয়ে কম থাকতে হবে।',
    ],
    'lte' => [
        'numeric' => ':attribute :value চেয়ে ছোট বা সমান হতে হবে।',
        'file' => ':attribute :value কিলোবাইট চেয়ে ছোট বা সমান হতে হবে।',
        'string' => ':attribute :value অক্ষর চেয়ে ছোট বা সমান হতে হবে।',
        'array' => ':attribute :value আইটেম বা তার চেয়ে কম থাকতে হবে।',
    ],
    'max' => [
        'numeric' => ':attribute :max চেয়ে বড় হতে পারে না।',
        'file' => ':attribute :max কিলোবাইট চেয়ে বড় হতে পারে না।',
        'string' => ':attribute :max অক্ষর চেয়ে বড় হতে পারে না।',
        'array' => ':attribute :max আইটেম চেয়ে বেশি থাকতে পারে না।',
    ],
    'mimes' => ':attribute একটি ফাইল হতে হবে প্রকার: :values।',
    'mimetypes' => ':attribute একটি ফাইল হতে হবে প্রকার: :values।',
    'min' => [
        'numeric' => ':attribute কমপক্ষে :min হতে হবে।',
        'file' => ':attribute কমপক্ষে :min কিলোবাইট হতে হবে।',
        'string' => ':attribute কমপক্ষে :min অক্ষর হতে হবে।',
        'array' => ':attribute কমপক্ষে :min আইটেম থাকতে হবে।',
    ],
    'not_in' => 'নির্বাচিত :attribute অবৈধ।',
    'not_regex' => ':attribute বিন্যাস অবৈধ।',
    'numeric' => ':attribute একটি সংখ্যা হতে হবে।',
    'password' => 'পাসওয়ার্ডটি ভুল।',
    'present' => ':attribute ক্ষেত্রটি উপস্থিত হতে হবে।',
    'regex' => ':attribute বিন্যাস অবৈধ।',
    'required' => ':attribute ক্ষেত্রটি প্রয়োজন।',
    'required_if' => ':other :value হলে :attribute ক্ষেত্রটি প্রয়োজন।',
    'required_unless' => ':other :values এ না থাকলে :attribute ক্ষেত্রটি প্রয়োজন।',
    'required_with' => ':values উপস্থিত হলে :attribute ক্ষেত্রটি প্রয়োজন।',
    'required_with_all' => ':values উপস্থিত হলে :attribute ক্ষেত্রটি প্রয়োজন।',
    'required_without' => ':values উপস্থিত না হলে :attribute ক্ষেত্রটি প্রয়োজন।',
    'required_without_all' => ':values এর কোনটি উপস্থিত না হলে :attribute ক্ষেত্রটি প্রয়োজন।',
    'same' => ':attribute এবং :other একই হতে হবে।',
    'size' => [
        'numeric' => ':attribute :size হতে হবে।',
        'file' => ':attribute :size কিলোবাইট হতে হবে।',
        'string' => ':attribute :size অক্ষর হতে হবে।',
        'array' => ':attribute :size আইটেম থাকতে হবে।',
    ],
    'starts_with' => ':attribute নিম্নলিখিত একটির সাথে শুরু হতে হবে: :values।',
    'string' => ':attribute একটি স্ট্রিং হতে হবে।',
    'timezone' => ':attribute একটি বৈধ জোন হতে হবে।',
    'unique' => ':attribute ইতিমধ্যে নেওয়া হয়েছে।',
    'uploaded' => ':attribute আপলোড করতে ব্যর্থ হয়েছে।',
    'url' => ':attribute বিন্যাস অবৈধ।',
    'uuid' => ':attribute একটি বৈধ UUID হতে হবে।',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'নিত্যসঙ্গ বার্তা',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
