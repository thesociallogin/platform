import { Container } from '@/components/container.jsx'
import { Gradient } from '@/components/gradient.jsx'
import { Link } from '@/components/link.jsx'
import { Navbar } from '@/components/navbar.jsx'
import { Button } from '@/components/ui/button.jsx'
import { ChevronRightIcon } from '@heroicons/react/16/solid'

export default function Hero() {
  return (
    <div className='relative'>
      <Gradient className='absolute inset-2 bottom-0 rounded-4xl ring-1 ring-inset ring-black/5' />
      <Container className='relative'>
        <Navbar
          banner={
            <Link
              href='/blog/radiant-raises-100m-series-a-from-tailwind-ventures'
              className='flex items-center gap-1 rounded-full bg-zinc-500/35 px-3 py-0.5 text-sm/6 font-medium text-white data-[hover]:bg-white/5'
            >
              The Social Login launches new service to help authentication.
              <ChevronRightIcon className='size-4' />
            </Link>
          }
        />
        <div className='pb-24 pt-16 sm:pb-32 sm:pt-24 md:pb-48 md:pt-32'>
          <h1 className='font-display text-balance text-6xl/[0.9] font-medium tracking-tight text-zinc-100 sm:text-7xl/[0.8] md:text-8xl/[0.8]'>
            Simplify authentication.
          </h1>
          <p className='mt-8 max-w-lg text-lg/7 font-medium text-zinc-300/75 sm:text-xl/8'>
            The Social Login helps you seamlessly integrate your app with any authentication service.
          </p>
          <div className='mt-12 flex flex-col gap-x-6 gap-y-4 sm:flex-row'>
            <Button variant='secondary' href='#'>
              Get started
            </Button>
            <Button href='/pricing'>See pricing</Button>
          </div>
        </div>
      </Container>
    </div>
  )
}
