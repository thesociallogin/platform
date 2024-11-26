export default function Footer() {
  return (
    <footer className='w-full bg-zinc-100 py-6'>
      <div className='container mx-auto flex max-w-6xl flex-col items-center justify-between px-4 md:flex-row md:px-6'>
        <div className='mb-4 text-zinc-700 md:mb-0'>© 2023 The Social Login. All rights reserved.</div>
        <nav>
          <ul className='flex space-x-4'>
            <li>
              <a href='#' className='text-zinc-600 hover:text-zinc-900'>
                Privacy Policy
              </a>
            </li>
            <li>
              <a href='#' className='text-zinc-600 hover:text-zinc-900'>
                Terms of Service
              </a>
            </li>
            <li>
              <a href='#' className='text-zinc-600 hover:text-zinc-900'>
                Contact
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </footer>
  )
}
