import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/react'
import { Bars2Icon } from '@heroicons/react/24/solid'
import { motion } from 'framer-motion'
import { useRoute } from 'ziggy-js'
import { Link } from './link'
import { Logo } from './logo'
import { PlusGrid, PlusGridItem, PlusGridRow } from './plus-grid'

function DesktopNav({ links }) {
  return (
    <nav className='relative hidden lg:flex'>
      {links.map(({ href, label, newTab }) => (
        <PlusGridItem key={label} className='relative flex'>
          <Link
            key={label}
            href={href}
            className='flex items-center px-4 py-3 text-base font-medium text-zinc-100 bg-blend-multiply data-[hover]:bg-white/[2.5%]'
            {...(newTab ? { target: '__blank' } : {})}
          >
            {label}
          </Link>
        </PlusGridItem>
      ))}
    </nav>
  )
}

function MobileNavButton() {
  return (
    <DisclosureButton
      className='flex size-12 items-center justify-center self-center rounded-lg data-[hover]:bg-black/5 lg:hidden'
      aria-label='Open main menu'
    >
      <Bars2Icon className='size-6' />
    </DisclosureButton>
  )
}

function MobileNav({ links }) {
  return (
    <DisclosurePanel className='lg:hidden'>
      <div className='flex flex-col gap-6 py-4'>
        {links.map(({ href, label, newTab }, linkIndex) => (
          <motion.div
            initial={{ opacity: 0, rotateX: -90 }}
            animate={{ opacity: 1, rotateX: 0 }}
            transition={{
              duration: 0.15,
              ease: 'easeInOut',
              rotateX: { duration: 0.3, delay: linkIndex * 0.1 }
            }}
            key={href}
          >
            <Link href={href} {...(newTab ? { target: '__blank' } : {})} className='text-base font-medium text-zinc-950'>
              {label}
            </Link>
          </motion.div>
        ))}
      </div>
      <div className='absolute left-1/2 w-screen -translate-x-1/2'>
        <div className='absolute inset-x-0 top-0 border-t border-black/5' />
        <div className='absolute inset-x-0 top-2 border-t border-black/5' />
      </div>
    </DisclosurePanel>
  )
}

export function Navbar({ banner }) {
  const route = useRoute()

  const links = [
    { href: route('web.home') + '#features', label: 'Features' },
    { href: route('web.home') + '#developers', label: 'Developers' },
    { href: route('filament.platform.tenant'), label: 'Login', newTab: true }
  ]

  return (
    <Disclosure as='header' className='pt-12 sm:pt-16'>
      <PlusGrid>
        <PlusGridRow className='relative flex justify-between'>
          <div className='relative flex gap-6'>
            <PlusGridItem className='py-3'>
              <Link href='/' title='Home'>
                <Logo className='h-9' />
              </Link>
            </PlusGridItem>
            {banner && <div className='relative hidden items-center py-3 lg:flex'>{banner}</div>}
          </div>
          <DesktopNav links={links} />
          <MobileNavButton />
        </PlusGridRow>
      </PlusGrid>
      <MobileNav links={links} />
    </Disclosure>
  )
}
