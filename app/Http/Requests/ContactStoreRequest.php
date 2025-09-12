<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:200',
                'min:2',
                'regex:/^[a-zA-Zぁ-んァ-ヶー一-龠\s]+$/u', // 英数字、ひらがな、カタカナ、漢字、スペースのみ
            ],
            'email' => [
                'required',
                'email:rfc,dns', // RFC準拠かつDNS検証
                'max:255',
                'filter_var:FILTER_VALIDATE_EMAIL',
            ],
            'subject' => [
                'required',
                'string',
                'max:500',
                'min:5',
                'regex:/^[^<>{}]+$/', // HTMLタグや危険な文字を禁止
            ],
            'message' => [
                'required',
                'string',
                'max:5000',
                'min:10',
                'regex:/^[^<>{}]+$/', // HTMLタグや危険な文字を禁止
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'お名前は必須です。',
            'name.min' => 'お名前は2文字以上で入力してください。',
            'name.max' => 'お名前は200文字以内で入力してください。',
            'name.regex' => 'お名前は英数字、ひらがな、カタカナ、漢字のみ使用できます。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',
            'subject.required' => '件名は必須です。',
            'subject.min' => '件名は5文字以上で入力してください。',
            'subject.max' => '件名は500文字以内で入力してください。',
            'subject.regex' => '件名に使用できない文字が含まれています。',
            'message.required' => 'メッセージは必須です。',
            'message.min' => 'メッセージは10文字以上で入力してください。',
            'message.max' => 'メッセージは5000文字以内で入力してください。',
            'message.regex' => 'メッセージに使用できない文字が含まれています。',
        ];
    }

    protected function prepareForValidation(): void
    {
        // 入力値の前処理
        $this->merge([
            'name' => trim(strip_tags($this->name)),
            'email' => strtolower(trim($this->email)),
            'subject' => trim(strip_tags($this->subject)),
            'message' => trim(strip_tags($this->message)),
        ]);
    }
}
