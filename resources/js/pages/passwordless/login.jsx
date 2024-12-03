import { Container } from '@/components/container.jsx'
import { Button } from '@/components/ui/button.jsx'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card.jsx'
import { Input } from '@/components/ui/input.jsx'
import { useForm } from '@inertiajs/react'

export default function Login({ provider, loginUri, flash }) {
  const { data, setData, post, processing, errors, clearErrors, reset } = useForm({
    code: '',
  })

  function submit(e) {
    e.preventDefault()
    clearErrors()
    post(loginUri, {
      preserveScroll: true,
      onSuccess: () => reset('code')
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
                <div className='text-sm text-gray-500'>Enter the one time code you received to login.</div>
                {flash.message && <div className='text-sm text-green-600 text-wrap'>{flash.message}</div>}
                <form onSubmit={submit} className='flex flex-col space-y-4'>
                  <div>
                    <Input
                      type='text'
                      autofocus
                      autocomplete='one-time-code'
                      value={data.code}
                      onChange={(e) => setData('code', e.target.value)}
                      placeholder='Code'
                    />
                    {errors.code && <div className='mt-1 text-sm text-red-600'>{errors.code}</div>}
                  </div>
                  <Button disabled={processing}>Login</Button>
                </form>
              </div>
            </CardContent>
          </Card>
      </Container>
    </div>
  )
}
