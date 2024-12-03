import { Container } from '@/components/container.jsx'
import { Button } from '@/components/ui/button.jsx'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card.jsx'
import { Input } from '@/components/ui/input.jsx'
import { useForm } from '@inertiajs/react'

export default function Email({ provider, flash }) {
  const { data, setData, post, processing, errors, clearErrors, reset } = useForm({
    email: ''
  })

  function submit(e) {
    e.preventDefault()
    clearErrors()
    post(`/${provider}/passwordless/email`, {
      preserveScroll: true,
      onSuccess: () => reset('email')
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
              <div className='text-sm text-gray-500'>Enter your email to receive a one-time code to login.</div>
              {flash.message && <div className='text-wrap text-sm text-green-600'>{flash.message}</div>}
              <form onSubmit={submit} className='flex flex-col space-y-4'>
                <div>
                  <Input
                    type='email'
                    autofocus
                    autocomplete='email'
                    value={data.email}
                    onChange={(e) => setData('email', e.target.value)}
                    placeholder='Email'
                  />
                  {errors.email && <div className='mt-1 text-sm text-red-600'>{errors.email}</div>}
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
