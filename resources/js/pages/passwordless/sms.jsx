import { Container } from '@/components/container.jsx'
import { Button } from '@/components/ui/button.jsx'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card.jsx'
import { Input } from '@/components/ui/input.jsx'
import { useForm } from '@inertiajs/react'

export default function Email({ provider, flash }) {
  const { data, setData, post, processing, errors, clearErrors, reset } = useForm({
    phone: ''
  })

  function submit(e) {
    e.preventDefault()
    clearErrors()
    post(`/${provider}/passwordless/sms`, {
      preserveScroll: true,
      onSuccess: () => reset('phone')
    })
  }

  return (
    <div className='flex h-screen items-center justify-center bg-zinc-50'>
      <Container>
        <Card>
          <CardHeader>
            <CardTitle>Login</CardTitle>
          </CardHeader>
          <CardContent className='flex justify-center'>
            <div className='flex flex-col space-y-4'>
              <div className='text-sm text-gray-500'>Enter your phone number to receive a one-time code to login.</div>
              {flash.message && <div className='text-wrap text-sm text-green-600'>{flash.message}</div>}
              <form onSubmit={submit} className='flex flex-col space-y-4'>
                <div>
                  <Input
                    type='text'
                    autofocus
                    autocomplete='phone_number'
                    value={data.email}
                    onChange={(e) => setData('phone', e.target.value)}
                    placeholder='Phone Number'
                  />
                  {errors.phone && <div className='mt-1 text-sm text-red-600'>{errors.phone}</div>}
                </div>
                <Button disabled={processing}>Send Code</Button>
              </form>
            </div>
          </CardContent>
        </Card>
      </Container>
    </div>
  )
}
