import { Button } from '@/components/ui/button.jsx'

export default function Header() {
  return (
    <header className='w-full bg-zinc-950 py-6 shadow-sm'>
      <div className='container mx-auto flex max-w-6xl items-center justify-between px-4 md:px-6'>
        <h1 className='text-2xl font-bold text-zinc-100'>The Social Login</h1>
        <nav>
          <ul className='flex items-center space-x-4'>
            <li>
              <a href='#features' className='text-zinc-200 hover:text-zinc-300'>
                Features
              </a>
            </li>
            <li>
              <a href='#pricing' className='text-zinc-200 hover:text-zinc-300'>
                Pricing
              </a>
            </li>
            <li>
              <a href='#' className='text-zinc-200 hover:text-zinc-300'>
                Docs
              </a>
            </li>
            <li>
              <Button variant='secondary'>Sign in</Button>
            </li>
          </ul>
        </nav>
      </div>
    </header>
  )
}
