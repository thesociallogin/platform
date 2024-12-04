import { faDiscord } from '@fortawesome/free-brands-svg-icons/faDiscord'
import { faFacebook } from '@fortawesome/free-brands-svg-icons/faFacebook'
import { faGoogle } from '@fortawesome/free-brands-svg-icons/faGoogle'
import { faLaravel } from '@fortawesome/free-brands-svg-icons/faLaravel'
import { faReact } from '@fortawesome/free-brands-svg-icons/faReact'
import { faSymfony } from '@fortawesome/free-brands-svg-icons/faSymfony'
import { faVuejs } from '@fortawesome/free-brands-svg-icons/faVuejs'
import { faXTwitter } from '@fortawesome/free-brands-svg-icons/faXTwitter'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { clsx } from 'clsx'

export function LogoCloud({ className }) {
  return (
    <div
      className={clsx(
        className,
        'flex justify-between max-sm:mx-auto max-sm:max-w-md max-sm:flex-wrap max-sm:justify-evenly max-sm:gap-x-4 max-sm:gap-y-4'
      )}
    >
      <FontAwesomeIcon icon={faGoogle} className='size-10 text-zinc-800' />
      <FontAwesomeIcon icon={faFacebook} className='size-10 text-zinc-800' />
      <FontAwesomeIcon icon={faXTwitter} className='size-10 text-zinc-800' />
      <FontAwesomeIcon icon={faDiscord} className='size-10 text-zinc-800' />
      <FontAwesomeIcon icon={faLaravel} className='size-10 text-zinc-800' />
      <FontAwesomeIcon icon={faSymfony} className='size-10 text-zinc-800' />
      <FontAwesomeIcon icon={faReact} className='size-10 text-zinc-800' />
      <FontAwesomeIcon icon={faVuejs} className='size-10 text-zinc-800' />
    </div>
  )
}
